<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <input type="file" @change="onFileChange" />
                        <div v-if="imageSrc">
                            <vue-croppa v-model="croppedImage" :ratio="1" :width="1000" :height="1000"
                                :canvas-color="canvasColor" @crop="onCrop"></vue-croppa>
                            <button @click="cropImage">Crop Image</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import 'vue-croppa/dist/vue-croppa.css';
export default {
    data() {
        return {
            imageSrc: null,
            croppedImage: null,
            canvasColor: '#fff',
        };
    },
    methods: {
        onFileChange(event) {
            const file = event.target.files[0];
            this.imageSrc = URL.createObjectURL(file);
        },
        onCrop(dataURL) {
            // Handle crop changes, if necessary
        },
        cropImage() {
            // Perform any action with the cropped image data
            console.log(this.croppedImage);
            // Reset the component state
            this.imageSrc = null;
            this.croppedImage = null;
        },
    },
}
</script>
