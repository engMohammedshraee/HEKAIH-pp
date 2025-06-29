<!-- <script setup>
import { route } from '../../../vendor/tightenco/ziggy/src/js';

// defineProps({
//     routeName:String,
//     componentName:String
// })
</script>
<template>
    <Link  class="px-3 py-2  rounded-lg
    hover:text-yellow-500"
     >
    <slot />
    </Link>
</template> -->
<script setup>
import { route } from '../../../vendor/tightenco/ziggy/src/js';

defineProps({
    routeName:String,
    componentName:String
})
</script>
<template>
    <Link :href="route(routeName)" class="px-3 py-2 text-black rounded-lg
    hover:text-yellow-500"
    :class="{'text-yellow-500' :$page.component===componentName}" >
    <slot />
    </Link>
</template>
