<template>
<div class="story__udalost">
    <div class="circle">
        <div class="stars">
        <div ref="starA" class="starA" >
            <img src="../../assets/svg/hvezda_mala.svg" role="img" alt="Simply Accessible" id="starA">
            <path id="pathA" d="M 0 100 c 0 0 -5 -10 -4 -13 s 1 -4 8 -8" />
        </div>
        <div class="starB">
            <img src="../../assets/svg/hvezda_mala.svg" role="img" alt="Simply Accessible" id="starB">
            
            <path id="pathB" d="M 0 0 c 0 0 18 20 15 32 " />
        </div>
        </div>
        <img id="question" src="../../assets/svg/otaznik.svg" role="img" alt="Simply Accessible" class="q">
        <span>Náhodná událost</span>
    </div>
</div>
</template>
<script>
import { gsap, Power1 } from 'gsap';
import { MotionPathPlugin } from 'gsap/all';

export default {
    mounted(){
       /*gsap.to("#question", {
            duration:1.3,
            y: "+=5px",
            yoyo: true,
            repeat: -1
        });
        gsap.registerPlugin(MotionPathPlugin);
        gsap.to(".starA", {
            duration: 3,
            repeat: -1,
            yoyo: true,
            ease: Power1.easeInOut,
            motionPath: {
                path: "#pathA",
                align: "#pathA",
                autoRotate: true,
                alignOrigin: [0.5, 0.5]
            }
        });
        gsap.to(".starB", {
            duration: 3,
            repeat: -1,
            yoyo: true,
            ease: Power1.easeInOut,
            motionPath: {
                path: "#pathB",
                align: "#pathB",
                autoRotate: true,
                alignOrigin: [0.5, 0.5]
            }
        });*/
    },
}
</script>