<script setup>
// import { swetchtheme } from "../theme";
// import NavLink from "../Component/NavLink.vue";
const page = usePage();
const user = computed(() => page.props.auth.user);
const show = ref(false);

import { Link, usePage } from "@inertiajs/vue3";
import NavLink from "../Component/NavLink.vue";
import { computed, ref } from "vue";
const goBack = () => {
    window.history.back();
};
</script>
<template>
    <header
        class="bg-slate-100 text-black shadow-lg shadow-[0_0_20px_rgba(22,220,220,3)]"
    >
        <nav class="flex items-center justify-between px-4">
            <div class="flex items-center text-2xl">
                <div class="flex items-center space-x-6 gap-4">
                    <!-----------------Auth--------------->

                    <div v-if="user" class="relative flex gap-15">
                        <div
                            @click="show = !show"
                            class="flex items-center gap-2 px-2 py-1 cursor-pointer rounded-lg"
                        >
                            <p>{{ user.name }}</p>
                            <img
                                :src="
                                    user.image
                                        ? `/storage/${user.image}`
                                        : `/storage/images/cards/users/mm.jpg`
                                "
                                alt=""
                                class="object-center h-15 w-15 rounded-full"
                            />
                            <i class="fa-solid fa-angle-down"></i>
                        </div>

                        <div class="flex items-center justify-between">
                            <button
                                @click="goBack"
                                class="flex items-center gap-2 hover:text-yellow-400"
                            >
                                <i
                                    class="fa-solid fa-arrow-left text-2xl text-yellow-300"
                                ></i>
                                رجوع
                            </button>
                        </div>

                        <!-- ---------------user dropdown menuo -->
                        <div
                            v-show="show"
                            @click="show = false"
                            class="absolute z-50 top-16 right-0 bg-slate-300 text-black rounded-lg overflow-hidden w-50 border-red-500 border"
                        >
                            <!-- <Link
                                :href="route('profile.mainpage')"
                                class="block w-full px-6 py-3 bg-yellow-700 text-left"
                            >
                                Profile</Link
                                                        > -->
                            <Link
                            :href="route('profile.mainpage',user.id)"
                             class="block w-full px-6 py-3 bg-yellow-700 text-left"
                             >
                                profile
                            </Link>




                            <Link
                                :href="route('dashboard')"
                                class="block w-full px-6 py-3 hover:bg-slate-700 hover:text-slate-300 text-left"
                            >
                                Dashboard</Link
                            >
                            <Link
                                method="post"
                                as="button"
                                :href="route('logout')"
                                class="block w-full px-6 py-3 hover:bg-slate-700 hover:text-slate-300 text-left"
                            >
                                logout</Link
                            >
                        </div>
                    </div>
                    <div v-else class="flex itrems-center gap-5">
                        <NavLink
                            routeName="register"
                            componentName="Auth/Register"
                        >
                            انشاء حساب
                        </NavLink>
                        <NavLink routeName="login" componentName="Auth/Login">
                            تسجيل الدخول
                        </NavLink>
                    </div>

                    <!-----------------gust--------------->
                </div>
            </div>
            <div class="flex items-center text-2xl gap-10">
                <NavLink routeName="about" componentName="About"
                    >حول الموقع
                </NavLink>
                <NavLink routeName="writers" componentName="Writers"
                    >الكُتاب</NavLink
                >
                <NavLink routeName="stories" componentName="Stories">
                    تصفح القصص
                </NavLink>
                <NavLink routeName="home" componentName="Home"
                    >الرئيسية</NavLink
                >
            </div>
            <div class="p-2 profile"></div>
        </nav>
    </header>
    <main class="mx-auto mx-w-screen-lg">
        <slot />
    </main>
</template>

<style scoped>
.profile {
    background-image: url("../../sass/imag/profile.png");
    background-size: cover;
    background-repeat: no-repeat;
    height: 80px;
    width: 150px;
}
</style>
