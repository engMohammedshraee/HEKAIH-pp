<script setup>
import Updateimage from "./Session/Updateimage.vue";
import UpdateProfile from "./Session/UpdateProfile.vue";
import Footer from "../../Component/Footer.vue";
import Updateinfo from "./Session/Updateinfo.vue";
import Sessionmessage from "../../Component/SessionMessage.vue";
import TextLInk from "../../Component/TextLInk.vue";
const props = defineProps({
  user: Object,
  phone: Object,
  status: String,
  success:String

});
const phone = props.phone ?? {
  phone_number: "",
  social_number: "",
};
</script>
<template>
  <Head title="EDIT-PROFILE" />
  <div>
    <Sessionmessage :status="status" />

    <Updateimage :user="user" />
    <UpdateProfile :user="user" />
    <Updateinfo :user="user" :phone="phone" />
    <Sessionmessage :status="success" />

    <div
      dir="rtl"
      class="bg-blue-500  px-5 py-5 mr-10 w-max rounded-[10px] mb-5 ml-auto"
    >
      <TextLInk
        class="py-3 text-white text-2xl px-5 hover:text-white"
        routeName="password.change"
        lable="تغيير كلمة المرور"
      />
      <i class="fa-solid fa-lock text-white"></i>

    </div>

    <Footer></Footer>
  </div>
</template>
