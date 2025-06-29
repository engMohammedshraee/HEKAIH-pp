<script setup>
// import { router, useForm } from '@inertiajs/vue3'
const props=defineProps({
    firstoption:String,
    // Card:Object
})
// const form=useForm({
//     category:props.Card.category
// })
// const submit=()=>{
//     if(confirm(`are you sure want chang role to-${form.role}`)){
//         form.put(route('admin.role',props.user.id))


//     }else{
//         form.role=props.user.role

//     }

// }

</script>
<template>
    <div class="flex items-center gap-2 rounded-lg bg-[#8858BB] px-2 mb-4">
        <form  action="" class="flex items-center gap-2  ">
            <i class="fa-solid fa-bars "></i>
            <select dir="rtl" name="roles" id="roles" class=" text-white bg-[#8858BB]
            text-2xl py-2 px-2  outline-0 rounded-lg" selected="" >
                 <option class="text-black px-4 bg-white" disabled value="">{{ firstoption }}</option>
                            <option class="text-black px-4 bg-white"  value="مغامرات">مغامرات</option>
                            <option class="text-black px-4 bg-white"  value="تعليمي">تعليمي</option>
                            <option class="text-black px-4 bg-white"  value="خيال علمي">خيال علمي</option>
                            <option class="text-black px-4 bg-white"  value="حيوانات">حيوانات</option>

            </select>


        </form>
        <div>

        </div>


    </div>

</template>
