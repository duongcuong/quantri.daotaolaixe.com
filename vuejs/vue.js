import { createApp } from "vue";
import VaccineItem from "./components/VaccineItem.vue";
import CureItem from "./components/CureItem.vue";
import BreedingItem from "./components/BreedingItem.vue";
import SaleItem from "./components/SaleItem.vue";

const app = createApp({});
app.component("VaccineItemComponent", VaccineItem);
app.component("BreedingItemComponent", BreedingItem);
app.component("CureItemComponent", CureItem);
app.component("SaleItem", SaleItem);
app.mount("#app");
