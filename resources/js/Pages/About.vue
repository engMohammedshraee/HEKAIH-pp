<script setup>
import Footer from "../Component/Footer.vue";
</script>
<template>
    <Head title="about us" />
       <div dir="rtl"
        class="relative max-w-screen-xl mx-auto  px-4 bg-white text-right py-60 text-black font-[Tajawal] rtl mt-4"
    >
        <!-- صورة الطفل -->
        <div
            class="absolute top-[-130px] left-[-50px] w-[600px] h-[600px] bg-cover bg-no-repeat z-10"
        ></div>

        <!-- البطاقة الأولى - مقدمة -->
        <div
            class="bg-white text-purple-700 font-bold rounded-xl shadow-md p-8 mb-6 z-20 relative"
        >
            <p class="text-2xl mb-2">حول موقع حكاية</p>
            <p class="text-black text-xl font-normal leading-relaxed">
                مرحبًا بكم في حكاية، عالم مليء بالقصص السحرية والمغامرات الشيقة!
                نحن هنا لنمنح الأطفال تجربة ممتعة ومفيدة من خلال قصص تزرع القيم،
                تنمي الخيال، وتفتح أبواب المعرفة بطريقة ممتعة وسهلة.
            </p>
        </div>

        <!-- البطاقة الثانية - الرؤية -->
        <div
            class="bg-purple-700 text-white rounded-xl shadow-md p-8 mb-6 text-xl font-bold leading-relaxed"
        >
            <p class="text-yellow-400 mb-2">رؤيتنا:</p>
            <p>
                نسعى لتقديم تجربة ممتعة وآمنة لتقديم محتوى مميز يلهم ويفرح
                الأطفال ويستخدم في نفس الوقت كأداة تعليمية بأكثر الطرق متعة
                وبساطة.
            </p>
        </div>

        <!-- ماذا نقدم؟ -->
        <div
            class="bg-purple-700 text-white rounded-xl shadow-md p-8 mb-6 text-xl font-bold leading-relaxed"
        >
            <p class="text-yellow-400 mb-2">ماذا نقدم؟</p>
            <ul class="list-disc pr-5 space-y-2">
                <li>
                    تقديم مجموعة واسعة من القصص المخصصة التي تلهم الفضول وتشجع
                    الأطفال على التعلم.
                </li>
                <li>
                    أدوات لتخصيص النصوص، الصور، والصوتيات في القصص بمكان مميز
                    خاص بك.
                </li>
                <li>
                    دعم الأنشطة الصفية والمنزلية لتحويل المحتوى التعليمي إلى
                    أداة تفاعلية جذابة.
                </li>
            </ul>
        </div>

        <!-- لماذا نحن؟ -->
        <div
            class="bg-purple-700 text-white rounded-xl shadow-md p-8 mb-6 text-xl font-bold leading-relaxed"
        >
            <p class="text-yellow-400 mb-2">لماذا نحن؟</p>
            <ul class="list-disc pr-5 space-y-2">
                <li>
                    نسهل إنشاء محتوى مميز مخصص يناسب طفلك وأهدافك التعليمية.
                </li>
                <li>نقدم تجربة مستخدم سلسة وبسيطة تلائم الجميع.</li>
            </ul>
        </div>

        <!-- انضموا إلينا -->
        <div
            class="bg-purple-700 text-white rounded-xl shadow-md p-8 mb-6 text-xl font-bold leading-relaxed"
        >
            <p class="text-yellow-400 mb-2">انضموا إلينا!</p>
            <p>
                إذا كنتم تحبون القصص وتؤمنون بأهميتها في بناء مستقبل مشرق
                للأطفال، ندعوكم لاستكشاف موقعنا والاستمتاع بعالم من الحكايات
                الرائعة!<br />
                📧 تواصل معنا: hekaya1000@gmail.com<br />
                📱 تابعونا على: facebook , instagram
            </p>
        </div>

        <!-- صورة خلفية -->
        <div class="backimag"
        ></div>
    </div>

    <Footer></Footer>
</template>
<style scoped>
.absolute{
background-image: url('../../sass/imag/childimg.png');
  position: absolute;
    height: 300px;
    width:300px;
    background-size: cover;
    top: -40px;
    left: -50px;
    z-index:3;
}

.backimag {
    background-image: url("../../sass/imag/backimage.png");
    position: absolute;
    height: 303px;
    width: 585px;
    background-size: cover;
    bottom: -45px;
    left: -50px;
    z-index: 1;
}

</style>
