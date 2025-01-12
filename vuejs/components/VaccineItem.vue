<template>
    <div class="p-2 border rounded mb-3">
        <div class="d-flex">
            <strong>Vaccine</strong>
        </div>
        <div class="table-responsive">
            <table class="table mb-0 table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Loại Vaccine</th>
                        <th scope="col">Ngày tiêm</th>
                        <th scope="col">Ngày tiêm tiếp theo</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(data, index) in datas" :key="index">
                        <td scope="col">
                            <select
                                class="form-control"
                                
                                :name="`vaccines[${index}][setting_vaccine_id]`"
                            >
                                <option selected value="">
                                    Chọn vaccine
                                </option>
                                <option v-for="list in lists" :value="list.id" :selected="list.id == data.setting_vaccine_id" :key="list">
                                    {{ list.name }}
                                </option>
                            </select>
                        </td>
                        <td scope="col">
                            <input
                                type="text"
                                :name="`vaccines[${index}][date_of_injection]`"
                                v-model="data.date_of_injection"
                                class="form-control datepicker datepicker-from"
                                placeholder="Chon ngày tiêm"
                            />
                        </td>
                        <td scope="col">
                            <input
                                type="text"
                                :name="`vaccines[${index}][next_injection_day]`"
                                v-model="data.next_injection_day"
                                class="form-control datepicker datepicker-to"
                                placeholder="Chon ngày tiêm tiếp theo"
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

datas.value = props.datas.length > 0 ? props.datas : [];

const removeItem = (index) => {
    showDeleteConfirmation(() => {
        datas.value.splice(index, 1);
    });
};
const handleAddItem = () => {
    
    if(datas.value.length > 0 ){
        datas.value.forEach((element, index) => {
            element.date_of_injection = $(`input[name="vaccines[${index}][date_of_injection]"]`).val();
            element.next_injection_day = $(`input[name="vaccines[${index}][next_injection_day]"]`).val();
        });
    }

    datas.value.push({
        setting_vaccine_id: "",
        date_of_injection: "",
        next_injection_day: "",
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
