<script setup>
import Paginate from "../../Component/Pagination.vue";
import Sessinonmessage from "../../Component/SessionMessage.vue";
import RoleSelect from "../../Component/RoleSelect.vue";

// import inputField from "../../Component/InputField.vue";
// import { router, useForm } from "@inertiajs/vue3";
const props=defineProps({
    user: Object,
    status: String,
});

// const params = route().params;
// const form = useForm({
//     search: params.search,
// });
// const search = () => {
//     router.get(route("admin.userController"), {
//         search: form.search,
//         user_role: params.user_role,
//     });
// };
// const toggle = (e) => {
//     if (e.target.checked) {
//         router.get(
//             route("admin.userController", {
//                 search: form.search,
//                 user_role: "مغلق",
//             })
//         );
//     } else {
//         router.get(
//             route("admin.userController", {
//                 search: form.search,
//                 user_role: null,
//             })
//         );
//     }
// };
import AdminLayout from "@/layout/adminlayout.vue";

defineOptions({
    layout: AdminLayout,
});
</script>
<template>
    <Head title="admin-dashoard" />
    <Sessinonmessage :status="status" />
    <!-- header -->
    <!-- <div class="flex items-center justify-between">
        <div class="flex items-end justify-between mb-4">
            <div class="flex items-center justify-center gap-2">
                <div>
                    <form @submit.prevent="search">
                        <inputField
                            label=""
                            icon="magnifying-glass"
                            placeholder="search"
                            type="search"
                            v-model="form.search"
                            class=""
                        />
                    </form>
                </div>
                <Link
                    class="bg-blue-500 text-white rounded-lg px-2 py-[7px]"
                    v-if="params.search"
                    :href="
                        route('admin.userController', {
                            ...params,
                            search: null,
                            page: null,
                        })
                    "
                >
                    {{ params.search }}
                    <i class="fa-solid fa-xmark"></i>
                </Link>
            </div>
        </div>
        <div class="mb-2 flex items-center gap-1 text-xs px-2 py-1 rounded-md">
            <input
                @input="toggle"
                type="checkbox"
                :checked="params.user_role"
                id="toggleRole"
                class="rounded-md border-1 outline-0 cursor-pointer"
            />
            <label
                for="toggleRole"
                class="font-midum block text-sm cursor-pointer"
                >show suspended user</label
            >
        </div>
    </div> -->

    <!-- table -->
    <div class=" p-2 border-4 border-purple-700 rounded-lg bg-purple-50">
        <table
            class="w-full p-2 table-fixed  overflow-hidden rounded-md text-sm ring-1 ring-slate-300 dark:ring-slate-600 shadow-lg min-w-full divide-y divide-purple-300 rounded-md overflow-hidden border-4 border-purple-700"
            dir="rtl"
        >
            <thead
                class="bg-purple-700 text-bold uppercase text-yellow-400 dark:bg-slate-900 dark:text-slate-400 bg-purple-800 border-b-4 border-purple-900 font-bold"
            >
                <tr>
                    <th class="w-3/6 p-3 text-right">الاسم</th>
                    <th class="w-2/6 py-5 px-3 text-right">الحالة</th>
                    <th class="w-1/6 py-5 px-3 text-right">عدد القصص</th>
                    <th class="w-1/6 py-5 px-3 text-right"> عرض قصص الكاتب</th>
                </tr>
            </thead>
            <tbody class="text-right" dir="rtl">
                <tr
                    class=" border-slate-200 hover:bg-slate-100 dark:bg-slate-800 dark:hover:bg-slate-600 dark:border-slate-600"
                >
                    <td class="w-3/6 p-3  border-2 border-purple-700">
                        <div
                            class="flex items-center gap-2 justify-start"
                            dir=""
                        >
                            <i class="fa-solid fa-user text-green-500 ml-2"></i>

                            <h4 class="font-bold">
                                {{ user.name }}
                            </h4>
                        </div>
                    </td>
                    <td class="w-2/6 py-5 px-3  border-2 border-purple-700">
                        <RoleSelect :user="user" />
                    </td>
                    <td class="w-1/6 py-5 px-3 border-2 border-purple-700">
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                <p>
                                    {{
                                        user.cards.filter((l) => l.approved)
                                            .length
                                    }}
                                </p>
                                <i
                                    class="fa-solid fa-circle-check text-green-500"
                                ></i>
                            </div>
                            <div class="flex items-center gap-2">
                                <p>
                                    {{
                                        user.cards.filter((l) => !l.approved)
                                            .length
                                    }}
                                </p>
                                <i
                                    class="fa-solid fa-circle-xmark text-red-500"
                                ></i>
                            </div>
                        </div>
                        <div class="p-2">العدد الكلي:{{ user.cards.length }}</div>
                    </td>
                    <td class="w-1/6 py-5 px-3  border-2 border-purple-700">
                        <Link
                            :href="route('user.hissotries', user.id)"
                            class="fa-solid fa-up-right-from-square px-3 text-indigo-400"
                        >
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <Paginate :paginator="user" />
    </div>
</template>
