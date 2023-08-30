<template>
    <div>
        <div class="main-content">
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Product</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-sm mb-3" @click="openProductModal">Upload
                                            Image</button>
                                        <div v-if="finalImages.length > 0">
                                            Product Images
                                            <div class="product-images">
                                                <div v-for="(image, index) in finalImages" :key="index"
                                                    class="product-image">
                                                    <img :src="image" @click="openGallery(index)" alt="Product Image" />
                                                    <button @click="removeImage(index)"
                                                        class="btn btn-circle btn-sm btn-danger">x</button>
                                                </div>
                                            </div>
                                            <gallery :images="finalImages" :index="activeImageIndex" ref="gallery">
                                            </gallery>
                                        </div>
                                        <div v-if="product.images">
                                            Uploaded Images
                                            <div class="product-images">
                                                <div v-for="(image, index) in  product.images " :key="index"
                                                    class="product-image">
                                                    <img :src="'/storage/product_images/' + image.image_file"
                                                        @click="openGallery(index)" alt="Product Image" />
                                                    <button @click="removeUploadedImage(image)" title="Remove"
                                                        class="btn btn-circle btn-sm btn-warning">x</button>
                                                </div>
                                            </div>
                                            <gallery :images="productImages" :index="activeImageIndex" ref="gallery">
                                            </gallery>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        Product Name
                                        <input v-model="product.name" type="text" class="form-control"
                                            placeholder="Product Name">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        Product Catalog
                                        <input v-model="product.catalog" type="text" class="form-control"
                                            placeholder="Product Catalog">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        Price
                                        <input v-model="product.price" type="number" min="0" max="1000000"
                                            class="form-control" placeholder="0.00">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        Remarks
                                        <textarea v-model="product.remarks" class="form-control" cols="30" rows="15"
                                            placeholder="Remarks"></textarea>
                                    </div>
                                </div>



                            </div>
                            <div class="card-footer">
                                <a href='/products' type="button" class="btn btn-secondary">Close</a>
                                <button class="btn btn-primary" :disabled="disable_save" @click="saveProduct">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div>
                        <button type="button" class="close mt-2 mr-2" @click="closeProductModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-header">
                        <h5 class="col-12 modal-title text-center">Upload Image</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="image-container">
                                    <input id="file_upload" type="file" @change="handleFileChange" accept="image/*"
                                        class="form-control" />
                                    <div v-if="imageSrc" class="mt-3">
                                        <vue-cropper ref="cropper" :src="imageSrc" :auto-crop-area="1" :view-mode="1"
                                            :drag-mode="null" :cropper-options="cropperOptions"></vue-cropper>
                                        <button @click="cropAndAddBackground"
                                            class="btn btn-primary btn-sm mt-2">Crop</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
import VueCropper from "vue-cropperjs";
import "cropperjs/dist/cropper.css";
import html2canvas from "html2canvas";
import Gallery from "vue-gallery";
import Swal from 'sweetalert2'

export default {
    props: ['product_id'],
    components: {
        VueCropper, Gallery
    },
    data() {
        return {
            imageSrc: "",
            finalImages: [],
            cropperOptions: {
                aspectRatio: 1, // Set aspect ratio to 1:1 (square)
                autoCropArea: 1, // Initial auto crop area (entire image)
                viewMode: 1, // Show the whole image in the crop box
                dragMode: null, // Disable drag mode
                cropBoxResizable: false, // Disable resizable crop box
            },

            activeImageIndex: 0,
            activeImageIndex2: 0,
            disable_save: false,

            product: {
                id: '',
                name: '',
                catalog: '',
                price: '',
                images: '',
            },

            productImages: [],
        };
    },
    created() {
        this.getProduct();
    },
    methods: {
        getProduct() {
            console.log(this.product_id)
            this.product = '';
            axios.get("/info-product/" + this.product_id).then((response) => {
                this.product = response.data;
                if (this.product.images) {
                    this.product.images.forEach(e => {
                        var url = window.location.origin + '/storage/product_images/' + e.image_file;
                        this.productImages.push(url);
                    });
                }

            });
        },
        saveProduct() {
            this.disable_save = true;
            Swal.fire({
                title: 'Are you sure you want to update this product?',
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();

                    var postURL = `/update-product`;
                    formData.append('id', this.product.id ? this.product.id : "");
                    formData.append('name', this.product.name ? this.product.name : "");
                    formData.append('catalog', this.product.catalog ? this.product.catalog : "");
                    formData.append('price', this.product.price ? this.product.price : "");
                    formData.append('images', this.finalImages ? JSON.stringify(this.finalImages) : "");


                    axios.post(postURL, formData)
                        .then(response => {
                            if (response.data.status == "saved") {
                                Swal.fire('Product has been saved!', '', 'success').then(function () {
                                    window.location.href = '/products';
                                });

                            } else {
                                Swal.fire('Error: Cannot changed. Please try again.', '', 'error');
                                this.disable_save = false;
                            }
                        })
                        .catch(error => {
                            this.errors = error.response.data.errors;
                            this.savingDisable = false;
                        })
                } else {
                    this.disable_save = false;
                }
            })

        },
        removeUploadedImage(image) {
            Swal.fire({
                title: 'Are you sure you want to remove this product image?',
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get("/remove-product-image/" + image.id).then((response) => {
                        if (response.data.status == 'saved') {
                            Swal.fire('Image has been removed!', '', 'success').then(function () {
                                location.reload();
                            });
                        }
                    });
                }
            });
        },
        removeImage(index) {
            this.finalImages.splice(index, 1);
        },
        openProductModal() {
            $('#product-modal').modal('show');
        },
        closeProductModal() {
            $('#product-modal').modal('hide');
        },
        openGallery(index) {
            this.activeImageIndex = index;
            this.$refs.gallery.open();
        },

        handleFileChange(event) {
            this.imageSrc = URL.createObjectURL(event.target.files[0]);
        },
        async cropAndAddBackground() {
            const cropper = this.$refs.cropper;
            const croppedCanvas = cropper.getCroppedCanvas();

            // Create a new canvas for adding white background
            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d");
            canvas.width = croppedCanvas.width;
            canvas.height = croppedCanvas.height;
            context.fillStyle = "#ffffff";
            context.fillRect(0, 0, canvas.width, canvas.height);
            context.drawImage(croppedCanvas, 0, 0);

            // Convert canvas to data URL (image)
            const finalImagesDataUrl = canvas.toDataURL("image/jpeg");
            this.finalImages.push(finalImagesDataUrl);

            this.imageSrc = '';
            document.getElementById('file_upload').value = '';

            this.closeProductModal();
        },
    },
};
</script>

<style>
.image-container {
    max-width: 450px;
}

.image-container img {
    /* This is important */
    width: 100%;
}
</style>

<style>
.product-images {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.product-image {
    cursor: pointer;
}

.product-image img {
    max-width: 100px;
    max-height: 100px;
}

.btn-circle {
    border-radius: 50%;
    width: 20px;
    height: 20px;
    padding: 0;
    font-size: 20px;
    line-height: 1;
}
</style>