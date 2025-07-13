<script setup>
import { useForm } from '@inertiajs/vue3'
const props=defineProps({
    user:Object
})
const form=useForm({
    role:props.user.role
})
const submit=()=>{
    if(confirm(`are you sure want chang role to-${form.role}`)){
        form.put(route('admin.role',props.user.id))


    }else{
        form.role=props.user.role

    }

}

</script>
<template>
    <div class="flex items-center gap-2">
        <form @change="submit" action="" class="flex items-center gap-2">
            <label for="roles" class="sr-only">Roles:</label>
            <select name="roles" id="roles" class="text-slate-800 bg-slate-200
            text-xs py-1 border-0 outline-0 rounded-lg" v-model="form.role">
                <option value="نشط">نشط</option>
                <option value="محظور">محظور</option>

                <option value="مغلق">مغلق</option>
                <option value="مشرف">مشرف</option>

            </select>


        </form>
        <div>

        </div>


    </div>

</template>
