<template>
    <div class="p-2 border rounded mb-3">
        <div class="d-flex">
            <strong>Danh sách phối giống</strong>
        </div>

        <div class="table-responsive">
            <table class="table mb-0 table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Ngày phối</th>
                        <th scope="col">Số tai đực</th>
                        <th scope="col">Ngày có chửa</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(data, index) in datas" :key="index">
                        <td scope="col">
                            <input
                                type="text"
                                class="form-control datepicker"
                            />
                        </td>
                        <td scope="col">
                            <select class="single-select form-control">
                                <option selected="" disabled="" value="">
                                    Nhập số tai con đực
                                </option>
                                <option>ABCXYZ1</option>
                                <option>ABCXYZ2</option>
                                <option>ABCXYZ3</option>
                                <option>ABCXYZ4</option>
                                <option>ABCXYZ5</option>
                            </select>
                        </td>
                        <td scope="col">
                            <input type="text" class="form-control datepicker" />
                        </td>
                        <td>
                            <button
                                class="btn btn-sm btn-danger"
                                type="button"
                                @click="removeItem(index)"
                            >
                                <i class="fadeIn animated bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-right mt-2">
            <button
                class="btn btn-warning px-3 btn-sm"
                type="button"
                title=""
                @click="handleAddItem"
            >
                <i class="bx bx-plus mr-1"></i>
                Thêm
            </button>
        </div>
    </div>
</template>
<script setup>
import { ref, defineProps } from "vue";
const props = defineProps(["datas"]);
const datas = ref([]);
datas.value = props.datas;
const removeItem = (index) => {
    showDeleteConfirmation(() => {
        datas.value.splice(index, 1);
    });
};
const handleAddItem = () => {
    datas.value.push({
        type: "ABC",
        date: "2/2/2022",
        date_2: "2/2/2022",
    });
};
</script>
<style></style>
