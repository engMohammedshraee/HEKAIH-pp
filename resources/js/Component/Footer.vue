<script setup></script>

<template>
    <div class="footer">
        <div class="icon"></div>
        <p class="text-white font-semibold text-lg mb-6">
            حكاية - عالم ممتع لقصص الأطفال <br />حكاية هو موقع تفاعلي مخصص
            للأطفال، يقدم مجموعة متنوعة من القصص المشوقة والمفيدة بتصميم جذاب
            يناسب الفئة العمرية الصغيرة. يهدف الموقع إلى تعزيز حب القراءة وتنمية
            الخيال لدى الأطفال من خلال قصص مصورة ونصوص سهلة الفهم، مع إمكانية
            الاستماع إلى القصص الصوتية . بالإضافة إلى ذلك، يوفر "حكاية" أنشطة
            تفاعلية تساعد الأطفال على التفاعل مع المحتوى بطريقة ممتعة وتعليمية.
        </p>

        <div class="icons">
            <div class="flex items-center justify-between px-4 py-4 gap-5">
                <span style="font-size: 20px; color: white;border-radius: 50%;">
                    <i class="fa-brands fa-facebook fa-2xl "></i>
                </span>
                <span style="font-size: 20px; color: white ;border-radius: 50%">
                   <i class="fa-brands fa-linkedin fa-2xl"></i>
                </span>
                <span style="font-size: 20px; color: white ;border-radius: 50%">
                     <i class="fa-brands fa-square-instagram fa-2xl"></i>
                </span>
                <span style="font-size: 20px; color: white">
                   <i class="fa-brands fa-whatsapp fa-2xl"></i>
                </span>




                <!-- LinkedIn -->

                <!-- Instagram -->

                <!-- Facebook -->

                <!-- WhatsApp -->
            </div>
        </div>
        <div class="socialtext">جميع الحقوق محفوظة لعام 2025</div>
    </div>
</template>
<script setup>
</script>
<style scoped>
div {
    direction: rtl;
}
.d-flex {
    color: #21a1d8;
}
.text-white {
    font-weight: 700;
    font-size: 20px;
    line-height: 37.47px;
}
strong {
    direction: rtl;
    font-size: 33px;
    font-weight: bold;
    color: rgb(166 34 210 / 96%);
}
p {
    color: white;
    font-size: 15px;
    font-weight: bold;
}
.footer {
    background-image: url("../../sass/imag/footer.png");
    width: 1530px;
    background-size: cover;
    direction: rtl;
    padding: 100px;
    margin-left: -7px;
    margin-top: -6px;
    margin: auto;
}



.socialtext {
    width: 500px;
    height: 52px;
    font-size: 30px;
    color: white;
    display: flex;
    align-content: center;
    margin: auto;
    padding-right: 100xp;
}
.icons {
    display: grid;
    grid-template-columns: auto auto auto auto;

    justify-content: space-between;
    width: 250px;
    margin-right: 37%;
}
.icon {
    height: 141px;
    width: 237px;
    background-image: url("../../sass/imag/profile.png");
    background-size: auto;
}
</style>
