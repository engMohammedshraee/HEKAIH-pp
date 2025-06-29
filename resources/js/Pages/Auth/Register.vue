<script setup>
import InputField from "../../Component/InputField.vue";
import Container from "../../Component/Container.vue";
import Title from "../../Component/Title.vue";
import Button from "../../Component/Button.vue";
import ErorrsMessage from "../../Component/ErorrsMessage.vue";
import { useForm } from "@inertiajs/vue3";

const form=useForm({
    name:"",
    email:"",
    password:"",
    password_confirmation:""
})
const submit =()=>{
    form.post(route('register.store'),{
        onFinish:()=>form.reset("password","password_confirmation"),
    });
}

</script>

<template>
    <Head title="register" />
    <Container class="w-2/3 ">
            <div
            class="flex items-center rounded-[15px] shadow-[0_0_20px_rgba(220,220,220,1)]"
        >

            <div class=" items-center px-10 py-20 w-1/2">
                <Title> انشاء حساب كقارى</Title>
                    <ErorrsMessage :errors="form.errors"/>


                <form @submit.prevent="submit">
                     <InputField
                        label="  ادخل اسمك"
                        placeholder=" الاسم"
                        v-model="form.name"
                    />

                    <InputField
                        label="ادخل البريد الالكتروني"
                        placeholder="البريد الالكتروني"
                        type="email"
                        v-model="form.email"
                    />

                    <InputField
                        label="ادخل كلمة المرور"
                        placeholder=" كلمة المرور"
                        v-model="form.password"
                    />

                       <InputField
                        label="تاكيد كلمة المرور"
                        placeholder=" كلمة المرور"
                        v-model="form.password_confirmation"
                    />

                    <Button :disabled="form.processing" class="w-full"> انشاء حساب</Button>
                </form>


            </div>
              <div
                class="w-1/2 bg-[#8858BB] h-[700px] text-white flex flex-col justify-center items-center relative rounded-tl-[171px] rounded-bl-[171px]"
            >
                <h2 class="font-bold mb-2 text-[2.5rem]"> مـرحـبا بعودتك</h2>
                <p class="mb-4"> لدي حساب؟</p>

                <!-- زر إنشاء حساب -->
                <button
                    @click="toggleRegistrationOptions"
                    class="bg-white text-[#8858BB] font-medium rounded-full px-4 py-2 mb-3 hover:bg-gray-100 transition"
                >
                <Link :href="route('login')"> تسجيل الدخول</Link>

                </button>

                <!-- خيارات التسجيل -->
                <div
                    v-if="showRegistrationOptions"
                    class="w-3/4 bg-white p-2 text-center"
                >
                    <a href="#">
                        <p class="m-0 text-black font-bold">التسجيل ككاتب</p>
                    </a>
                </div>

                <div
                    v-if="showRegistrationOptions"
                    class="w-3/4 bg-white p-2 text-center"
                >
                    <a href="#">
                        <p class="m-0 text-purple-600 font-bold">
                            التسجيل كقاري
                        </p>
                    </a>
                </div>
            </div>
        </div>

    </Container>
</template>
