<template>
    <div>
        <div class="main-content">
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>New Product</h4>
                            </div>
                            <div class="card-body">
                                <input ref="filePickerField" type="file" accept="image/*" @change="launchCropper" hidden />

                                <div>
                                    <v-avatar size="350px" class="mt-5" style="border: 2px solid black;">
                                        <v-img :src="avatarImage"></v-img>
                                    </v-avatar>
                                </div>

                                <v-btn class="mt-5" @click="$refs.filePickerField.click()"> Upload </v-btn>

                                <image-cropper-dialog ref="cropperDialog" :chosenImage="chosenImage"
                                    @onReset="$refs.filePickerField.value = null" @onCrop="(croppedImage) => {
                                        avatarImage = croppedImage;
                                    }" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import ImageCropperDialog from './ImageCropperDialog.vue';
export default {
    name: 'HomePage',
    components: {
        ImageCropperDialog,
    },
    data() {
        return {
            avatarImage: require("../assets/default.jpg"),
            chosenImage: null,
        }
    },
    methods: {
        async launchCropper(event) {
            if (!event) return;
            var file = event.target.files[0];
            this.chosenImage = await this.toBase64(file);
            this.$refs.cropperDialog.initCropper(file.type);
        },

        async toBase64(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => resolve(reader.result);
                reader.onerror = error => reject(error);
            });
        },
    }
}
</script>

<style lang="scss" scoped></style>