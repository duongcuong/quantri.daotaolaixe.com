<template>
    <div class="p-2 border rounded mb-3">
        <div class="d-flex">
            <strong>Điều trị bệnh</strong>
        </div>
        <div class="table-responsive">
            <table class="table mb-0 table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Loại bệnh</th>
                        <th scope="col">Ngày mắc</th>
                        <th scope="col">Thuốc điều trị</th>
                        <th scope="col">Ngày hồi phục</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(data, index) in datas" :key="index">
                        <td scope="col">
                            <select
                                class="form-control"
                                
                                :name="`healths[${index}][setting_disease_id]`"
                            >
                                <option selected value="">
                                    Chọn loại bệnh
                                </option>
                                <option v-for="list in lists" :selected="list.id == data.setting_disease_id" :value="list.id" :key="list">
                                    {{ list.name }}
                                </option>
                            </select>
                        </td>
                        <td scope="col">
                            <input
                                type="text"
                                :name="`healths[${index}][day_of_illness]`"
                                :value="data.day_of_illness"
                                placeholder="Chọn ngày mắc"
                                class="form-control datepicker datepicker-from"
                            />
                        </td>
                        <td scope="col">
                            <input
                                type="text"
                                :name="`healths[${index}][medicine]`"
                                :value="data.medicine"
                                placeholder="Nhập thuốc điều trị"
                                class="form-control"
                            />
                        </td>

                        <td scope="col">
                            <input
                                type="text"
                                :name="`healths[${index}][day_of_recovery]`"
                                :value="data.day_of_recovery"
                                class="form-control datepicker datepicker-to"
                                placeholder="Nhập ngày hồi phục"
                            />
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
const props = defineProps(["datas", "lists"]);
const datas = ref([]);

datas.value =
    props.datas.length > 0
        ? props.datas
        : [];
const removeItem = (index) => {
    showDeleteConfirmation(() => {
        datas.value.splice(index, 1);
    });
};
const handleAddItem = () => {

    if(datas.value.length > 0 ){
        datas.value.forEach((element, index) => {
            element.day_of_illness = $(`input[name="healths[${index}][day_of_illness]"]`).val();
            element.day_of_recovery = $(`input[name="healths[${index}][day_of_recovery]"]`).val();
        });
    }

    datas.value.push({
        day_of_illness: "",
        setting_disease_id: "",
        day_of_recovery: "",
        medicine: ""
    });
    setTimeout(function () {
        $(".datepicker").pickadate({
            selectMonths: true,
            selectYears: true,
            icon: '<i class="fa fa-calendar"></i>',
            format: "dd/mm/yyyy",
        });
    }, 200);
};
</script>
<style></style>
