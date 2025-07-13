<script setup>
import Title from "../../Component/Title.vue";
import SessionMessage from "../../Component/SessionMessage.vue";
import PaginatinLinks from "../../Component/Pagination.vue";
// import inputField from "../../Component/InputField.vue";
import { router} from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
    cards: {
        type: Array,
        required: true,
        default: () => [],
    },
    status: String,
});

// const params = route().params;
// const form = useForm({
//     search: params.search,
// });
// const search = () => {
//     router.get(
//         route("admin.hissotries", {
//             card: props.card.id,
//             search: form.search,
//         })
//     );
// };

// const showdisapproved = (e) => {
//     if (e.target.checked) {
//         router.get(
//             route("admin.hissotries", {
//                 card: props.user.id,
//                 search: form.search,
//                 disapproved: true,
//             })
//         );
//     } else {
//         router.get(
//             route("admin.hissotries", {
//                 card: props.user.id,
//                 search: form.search,
//                 disapproved: null,
//             })
//         );
//     }
// };
const toggleapproved = (card) => {
    const mes = card.approved ? 'توقيف القصة' : 'تفعيل القصة'
    if (confirm(mes)) {
        router.put(route('admin.approved', card.id))

    }

}
import AdminLayout from "@/layout/adminlayout.vue";

defineOptions({
    layout: AdminLayout,
});
</script>
<template>

    <Head title="user-stories" />

    <div class="">

        <div class="border-purple-700 rounded-lg items-center">
        <SessionMessage :status="status" />

            <Title>القصص الخاصة ب:{{ user.name }}</Title>

            <table class="mx-auto divide-y divide-purple-300 rounded-md border-4 border-purple-700">
                <thead class="bg-purple-800 border-b-4 border-purple-900 font-bold">
                    <tr>
                        <th
                            class="w-2/10 px-6 py-3 text-right font-medium text-yellow-400 uppercase tracking-wider border-r-2 border-purple-700">
                            العنوان
                        </th>
                        <th
                            class="w-1/10 px-6 py-3 text-right font-medium text-yellow-400 uppercase tracking-wider border-r-2 border-purple-700">
                            الفئة
                        </th>
                        <th
                            class="w-2/10 px-6 py-3 text-right font-medium text-yellow-400 uppercase tracking-wider border-r-2 border-purple-700">
                            المستوى
                        </th>
                        <th
                            class="w-2/10 px-6 py-3 text-right font-medium text-yellow-400 uppercase tracking-wider border-r-2 border-purple-700">
                            الحالة
                        </th>

                        <th class="w-2/10 px-6 py-3 text-right font-medium text-yellow-400 uppercase tracking-wider">
                            عرض القصة
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-purple-200">
                    <tr v-for="(card, i) in cards" :key="i" class="hover:bg-purple-100">
                        <td class="px-6 py-4 whitespace-nowrap border-r-2 border-purple-200 font-bold">
                            {{ card.titel.substring(1,10) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-r-2 border-purple-200 font-bold">
                            {{ card.category }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-r-2 border-purple-200 font-bold">
                            {{ card.level }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-r-2 border-purple-200 font-bold">
                            <button @click.prevent="toggleapproved(card)">
                                <i :class="`fa-solid fa-${card.approved
                                    ? 'circle-check text-green-500'
                                    : 'circle-xmark text-red-500'}

                            `">

                                </i>
                            </button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-bold border-r-2 border-purple-200">
                             <Link
                            :href="route('admin.showstory',card.id)"
                            class="fa-solid fa-up-right-from-square px-3 text-indigo-400"
                        >
                        </Link>
                        </td>
                    </tr>
                    <tr v-if="cards.length === 0" class="bg-white">
                        <td colspan="4"
                            class="px-6 py-4 text-center text-sm font-medium text-gray-500 border-t-2 border-purple-200">
                            لا توجد قصص لعرضها
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-3 flex items-center justify-center">
                <PaginatinLinks :paginator="cards" />
            </div>
        </div>

        <!-- <table
            class="px-50 w-full table-fixed border-collapse
            overflow-hidden rounded-md text-sm rang-1 ring-slate-300
             dark:ring-slat-600 bg-white shadow-lg">
            <thead class="bg-slate-300 text-xs uppercase text-yellow-600
             dark:bg-slate-900 dark:text-slate-400">
                <tr>
                    <th class="w-4/6 p-3 text-left">Titel</th>
                    <th class="w-1/6 py-5 px-3 text-left">approved</th>
                    <th class="w-1/6 py-5 px-3 text-left">view link</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for ="card in cards" :key="card.id"
                    class="border-b border-slate-200 hover:bg-slate-100 dark:bg-slate-1000
                     dark:hover:bg-slate-600 dark:border-slate-600">
                    <td class="w-4/6 p-3 text-left">
                        <div class="flex items-center gap-2">
                            <h4 class="font-bold">
                                <i class="fa-solid fa-card text-green-500"></i>
                                {{ card.titel }}
                            </h4>
                        </div>
                    </td>
                    <td class="w-1/6 py-5 px-3 text-left">
                        <button>
                            {{ card.titel }}

                        </button>

                    </td>
                    <td class="w-1/6 py-5 px-3 text-left">
                        <Link href="#" class="fa-solid fa-up-right-from-square px-3 text-indigo-400">
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table> -->
    </div>
</template>
