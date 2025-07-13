<script setup>
import InputField from "../Component/InputField.vue";
import Footer from "../Component/Footer.vue";
import StarRation from "../Component/StarRation.vue";
import Pagination from "../Component/Pagination.vue";

const props = defineProps({
    users: Object,
});

console.log(props.users);
</script>

<template>
    <Head title="writers" />
    <div class="relative">
        <div class="flex space-x-2 justify-center py-10 mx-auto">
            <InputField
                class="w-1/2 mx-auto"
                type="search"
                placeholder="بحث  "
                icon="magnifying-glass"
            />
        </div>

        <div
            v-if="Object.keys(props.users.data).length"
            class="px-50 background"
        >
            <div class="grid grid-cols-3 gap-10">
                <div
                    dir="rtl"
                    v-for="user in props.users.data"
                    :key="user.id"
                    class="bg-white rounded-[10px] py-6 px-6"
                >
                    <Link
                        :href="route('login', user.id)"
                        class="flex space-x-2 justify-center py-3 mb-2"
                    >
                        <img
                            :src="
                                user.image
                                    ? `/storage/${user.image}`
                                    : `/storage/images/cards/users/mm.jpg`
                            "
                            alt=""
                            class="object-center h-60 w-60 rounded-full"
                        />
                    </Link>
                    <div class="p-2 flex space-x-2 justify-center">
                        <h3 class="text-4xl">
                            {{ user.name }}
                        </h3>
                    </div>
                    <div class="p-2 flex space-x-2 justify-center">
                        <p>
                            {{ user.defenation }}
                        </p>
                    </div>
                    <div>
                        <StarRation :user="user" />
                    </div>
                    <div class="flex space-x-2 justify-center">
                        <Button
                            class="flex justify-between bg-yellow-500 p-5 rounded-[10px] hover:bg-yellow-500"
                        >
                            <Link
                             :href="route('writerknow', user.id)"
                                class="block w-full   text-left"
                            >
                                تعرف على الكاتب
                            </Link>
                        </Button>
                    </div>
                </div>
            </div>
            <div class="mt-8 px-2 py-2">
                <Pagination :paginator="users" />
            </div>
        </div>
        <div class="image"></div>
        <Footer></Footer>
    </div>
</template>
<style scoped>
.background {
    width: 1531px;
    height: 910px;
    background-color: #8858bb;
    background-image: url("../../sass/imag/Vector.png");
    margin: auto;
    margin-bottom: 393px;
    position: relative;
    padding: 135px;
}
.image {
    background-image: url("../../sass/imag/backimage.png");
    position: absolute;
    height: 347px;
    width: 663px;
    background-size: cover;
    bottom: 600px;
    z-index: 1;
    right: 0;
}
</style>
