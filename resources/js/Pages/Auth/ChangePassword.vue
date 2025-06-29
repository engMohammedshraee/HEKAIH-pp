<script setup>
import { useForm } from '@inertiajs/vue3';


const form = useForm({
    current_password: '',
    new_password: '',
    new_password_confirmation: '',
});
</script>

<template>
    <Head title="chang_Password"/>

    <div dir="rtl" class="max-w-md mx-auto mt-20 bg-white p-6 rounded shadow">
        <h1 class="text-2xl mb-6 text-center font-bold">تغيير كلمة المرور</h1>

        <form @submit.prevent="form.post(route('password.updateafterlogin'))">
            <div class="mb-4">
                <label class="block mb-1">كلمة المرور الحالية</label>
                <input v-model="form.current_password" type="password" class="w-full p-2 border rounded" />
                <div v-if="form.errors.current_password" class="text-red-500 text-sm mt-1">{{
                    form.errors.current_password }}</div>
            </div>

            <div class="mb-4">
                <label class="block mb-1">كلمة المرور الجديدة</label>
                <input v-model="form.new_password" type="password" class="w-full p-2 border rounded" />
                <div v-if="form.errors.new_password" class="text-red-500 text-sm mt-1">{{ form.errors.new_password }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1">تأكيد كلمة المرور الجديدة</label>
                <input v-model="form.new_password_confirmation" type="password" class="w-full p-2 border rounded" />
            </div>

           <button
  :disabled="form.processing"
  class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-max mx-auto flex justify-center items-center"
>
  تحديث كلمة المرور
</button>

        </form>

        <div v-if="$page.props.flash?.success" class="mt-4 text-green-600 text-center">
            {{ $page.props.flash.success }}
            
        </div>

    </div>
</template>
