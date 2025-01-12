<template>
    <div
        class="card shadow-none border position-relative"
        v-for="(data, index) in datas"
        :key="index"
    >
        <button v-if="showButton"
            class="btn btn-sm btn-danger remove-item"
            type="button"
            @click="removeItem(index)"
        >
            <i class="fadeIn animated bx bx-x"></i>
        </button>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="validationCustom01" class="form-label"
                        >Mã đàn/Mã tai <span class="text-danger">*</span></label
                    >
                    <select
                        class="select2-ajax-single form-control"
                        :class="errors.hasOwnProperty(`sales.${index}.code`) && errors[`sales.${index}.code`].length > 0 ? 'is-invalid' : ''"
                        :name="`sales[${index}][code]`"
                        :data-selected-id="data.code"
                        data-type="-1"
                        data-placeholder="Nhập mã"
                        :data-url="url"
                        data-limit="10"
                    ></select>
                    <div class="invalid-feedback">{{ errors.hasOwnProperty(`sales.${index}.code`) && errors[`sales.${index}.code`].length > 0 ? errors[`sales.${index}.code`].join(', ') : '' }}</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom01" class="form-label"
                        >Số lượng <span class="text-danger">*</span></label
                    >
                    <input
                        type="number"
                        class="form-control"
                        :class="errors.hasOwnProperty(`sales.${index}.total`) && errors[`sales.${index}.total`].length > 0 ? 'is-invalid' : ''"
                        :value="data.total"
                        :name="`sales[${index}][total]`"
                        placeholder="Nhập số lượng"
                    />
                    <div class="invalid-feedback">{{ errors.hasOwnProperty(`sales.${index}.total`) && errors[`sales.${index}.total`].length > 0 ? errors[`sales.${index}.total`].join(', ') : '' }}</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom01" class="form-label"
                        >Trọng lượng (kg)
                        <span class="text-danger">*</span></label
                    >
                    <input
                        type="number"
                        class="form-control"
                        :class="errors.hasOwnProperty(`sales.${index}.weight`) && errors[`sales.${index}.weight`].length > 0 ? 'is-invalid' : ''"
                        :value="data.weight"
                        :name="`sales[${index}][weight]`"
                        placeholder="Nhập trọng lượng"
                    />
                    <div class="invalid-feedback">{{ errors.hasOwnProperty(`sales.${index}.weight`) && errors[`sales.${index}.weight`].length > 0 ? errors[`sales.${index}.weight`].join(', ') : '' }}</div>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01" class="form-label"
                        >Ghi chú
                    </label>
                    <textarea
                        rows="2"
                        class="form-control"
                        :value="data.note"
                        :name="`sales[${index}][note]`"
                        placeholder="Nhập địa chỉ"
                    ></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right" v-if="showButton">
        <button
            class="btn btn-warning px-3 btn-sm"
            type="button"
            title=""
            @click="handleAddItem"
        >
            <i class="bx bx-plus mr-1"></i> Thêm
        </button>
    </div>
</template>
<script setup>
import { ref, defineProps } from "vue";
const props = defineProps(["datas", "lists", "url", "errors", "showButton"]);
const datas = ref([]);
const objEmpty = {
    category: "",
    code: "",
    total: "",
    weight: "",
    note: "",
};
datas.value = props.datas.length > 0 ? props.datas : [objEmpty];
const removeItem = (index) => {
    if (datas.value.length > 1) {
        showDeleteConfirmation(() => {
            datas.value.splice(index, 1);
        });
    }
};
const handleAddItem = () => {
    datas.value.push(objEmpty);
    setTimeout( ()=>{
        resetSelectAjax();
    }, 200 )
};
</script>
<style></style>
