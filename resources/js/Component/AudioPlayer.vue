<script setup>
import { ref, watch, computed } from "vue";
import { Link } from "@inertiajs/vue3";



const props = defineProps({
    card:Object,
    src: {
        type: String,
        required: false,
        default: null,
    },
});

const audioRef = ref(null);
const isPlaying = ref(false);
const currentTime = ref(0);
const duration = ref(0);
const hasError = ref(false);

const hasAudio = computed(() => !!props.src && !hasError.value);

const togglePlay = () => {
    if (!audioRef.value || !hasAudio.value) return;
    if (isPlaying.value) {
        audioRef.value.pause();
    } else {
        audioRef.value.play();
    }
    isPlaying.value = !isPlaying.value;
};

const loadedMetadata = () => {
    if (audioRef.value) duration.value = audioRef.value.duration;
    hasError.value = false; // تأكيد أنه تم التحميل بنجاح
};

const updateTime = () => {
    if (audioRef.value) currentTime.value = audioRef.value.currentTime;
};

const onSeek = (e) => {
    if (audioRef.value) {
        const value = parseFloat(e.target.value);
        audioRef.value.currentTime = value;
        currentTime.value = value;
    }
};

const skip = (seconds) => {
    if (audioRef.value) {
        let newTime = audioRef.value.currentTime + seconds;
        if (newTime < 0) newTime = 0;
        if (newTime > duration.value) newTime = duration.value;
        audioRef.value.currentTime = newTime;
        currentTime.value = newTime;
    }
};

const formatTime = (time) => {
    const minutes = Math.floor(time / 60);
    const seconds = Math.floor(time % 60)
        .toString()
        .padStart(2, "0");
    return `${minutes}:${seconds}`;
};

// إذا تغيّر الصوت، أعد الضبط
watch(
    () => props.src,
    () => {
        if (audioRef.value) {
            audioRef.value.pause();
            isPlaying.value = false;
            currentTime.value = 0;
            hasError.value = false;
        }
    }
);

// عند حصول خطأ في تحميل الصوت
const onError = () => {
    hasError.value = true;
};
</script>

<template>
    <div v-if="!hasAudio" class="bg-white text-lg font-medium leading-relaxed">
        <p class="text-red-500 text-5xl py-5">
            <i class="fa-solid fa-ban"></i>
        </p>

        <p class="py-2 text-red-500 text-3xl">
            عذرًا، لا يتوفر حاليًا تسجيل صوتي لهذه القصة
        </p>
        <p class="py-2 text-[#8AC926] text-3xl">
            لكن لا تقلق! يمكنك قراءتها بنفسك والاستمتاع بها.
        </p>
        <div class="flex justify-center items-center py-4">
             <Link
            :href="route('Card.show', card.id)"
            class="flex justify-between items-center bg-blue-500 w-50 hover:bg-yellow-600 rounded-lg px-4 py-2"
        >
            <span style="font-size: 20px; color: black">
                <i class="fa-solid fa-book-open text-white"></i>
                قراءة القصة
            </span>
        </Link>

        </div>

    </div>
    <div
        v-else
        class="bg-purple-600 py-10 px-50 rounded-xl w-full text-white text-center"
    >

        <div>
            <div class="w-full mb-4">
                <input
                    type="range"
                    min="0"
                    :max="duration"
                    step="0.1"
                    :value="currentTime"
                    @input="onSeek"
                    class="w-full appearance-none h-2 rounded bg-white accent-yellow-400"
                />
                <div class="flex justify-between text-sm mt-1 text-white">
                    <span>{{ formatTime(currentTime) }}</span>
                    <span>{{ formatTime(duration) }}</span>
                </div>
            </div>

            <div
                class="flex justify-center items-center gap-6 text-yellow-400 text-3xl"
            >
                <button
                    @click="skip(-10)"
                    class="bg-purple-700 text-yellow-400 px-4 py-2 rounded hover:bg-purple-600 focus:outline-none"
                >
                    <font-awesome-icon :icon="['fas', 'backward']" />
                </button>

                <button
                    @click="togglePlay"
                    class="bg-purple-700 text-yellow-400 px-4 py-2 rounded hover:bg-purple-600 focus:outline-none flex items-center justify-center"
                >
                    <font-awesome-icon
                        :icon="isPlaying ? ['fas', 'pause'] : ['fas', 'play']"
                    />
                </button>

                <button
                    @click="skip(10)"
                    class="bg-purple-700 text-yellow-400 px-4 py-2 rounded hover:bg-purple-600 focus:outline-none"
                >
                    <font-awesome-icon :icon="['fas', 'forward']" />
                </button>
            </div>

            <audio
                ref="audioRef"
                :src="src"
                @loadedmetadata="loadedMetadata"
                @timeupdate="updateTime"
                @error="onError"
                class="hidden"
            />
        </div>
    </div>
</template>
