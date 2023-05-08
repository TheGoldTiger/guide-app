 
 <script>
    import gsap, { Bounce, Power3 } from 'gsap';
import { mapGetters } from 'vuex';
    
    export default {
      name: "End",
      data() {
        return {
            shared: true,
            audio: new Audio("https://nocvedcu.vse.cz/api/assets/10_zaver.mp3"),
            isPlaying: false,
            tl: null,
            tl2: null,
        }
      },
      computed:{
        ...mapGetters(['getMoney', 'getMe'])
      },
      async mounted(){
            await this.$store.dispatch('isWinnerDisplay', this.getMe.id).then((response)=>{
                if (!response) {
                    this.shared = false
                }
            })


            this.audio.addEventListener('ended', (event)=>{
                this.playAudio();
            })

            
            this.tl = gsap.timeline({repeat:-1, paused: true, defaults:{ease:"none"}})
            .to("#marque",{left:"0", duration:0})
            .to("#marque2",{left:"-100%", duration:0})
            .to("#marque",{left:"100%", duration:10})
            .to("#marque2",{left:"0", duration:10},"<"); 
            this.tl2 = gsap.timeline({repeat:-1, paused: true, defaults:{ease:"none"}}).to("#listen_icon",{duration: 0.75, repeat:-1, scale: 1.3, yoyo: true, ease: Bounce.easeOut, yoyoEase:Power3.easeOut});
            

                    // global variables
            const confetti = document.getElementById('confetti');
            const confettiCtx = confetti.getContext('2d');
            let container, confettiElements = [], clickPosition;

            // helper
            function rand(min, max) 
            {
                let random = Math.random() * (max - min) + min;
                return random;
            } 

            // params to play with
            const confettiParams = {
                // number of confetti per "explosion"
                number: 70,
                // min and max size for each rectangle
                size: { x: [5, 20], y: [10, 18] },
                // power of explosion
                initSpeed: 25,
                // defines how fast particles go down after blast-off
                gravity: 0.65,
                // how wide is explosion
                drag: 0.08,
                // how slow particles are falling
                terminalVelocity: 6,
                // how fast particles are rotating around themselves
                flipSpeed: 0.017,
            };
            const colors = [
                { front : '#3B870A', back: '#235106' },
                { front : '#B96300', back: '#6f3b00' },
                { front : '#E23D34', back: '#88251f' },
                { front : '#CD3168', back: '#7b1d3e' },
                { front : '#664E8B', back: '#3d2f53' },
                { front : '#394F78', back: '#222f48' },
                { front : '#008A8A', back: '#005353' },
            ];

            setupCanvas();
            updateConfetti();

            confetti.addEventListener('click', addConfetti);
            window.addEventListener('resize', () => {
                setupCanvas();
                hideConfetti();
            });

            // Confetti constructor
            function Conf() {
                this.randomModifier = rand(-1, 1);
                this.colorPair = colors[Math.floor(rand(0, colors.length))];
                this.dimensions = {
                    x: rand(confettiParams.size.x[0], confettiParams.size.x[1]),
                    y: rand(confettiParams.size.y[0], confettiParams.size.y[1]),
                };
                this.position = {
                    x: clickPosition[0],
                    y: clickPosition[1]
                };
                this.rotation = rand(0, 2 * Math.PI);
                this.scale = { x: 1, y: 1 };
                this.velocity = {
                    x: rand(-confettiParams.initSpeed, confettiParams.initSpeed) * 0.4,
                    y: rand(-confettiParams.initSpeed, confettiParams.initSpeed)
                };
                this.flipSpeed = rand(0.2, 1.5) * confettiParams.flipSpeed;

                if (this.position.y <= container.h) {
                    this.velocity.y = -Math.abs(this.velocity.y);
                }

                this.terminalVelocity = rand(1, 1.5) * confettiParams.terminalVelocity;

                this.update = function () {
                    this.velocity.x *= 0.98;
                    this.position.x += this.velocity.x;

                    this.velocity.y += (this.randomModifier * confettiParams.drag);
                    this.velocity.y += confettiParams.gravity;
                    this.velocity.y = Math.min(this.velocity.y, this.terminalVelocity);
                    this.position.y += this.velocity.y;

                    this.scale.y = Math.cos((this.position.y + this.randomModifier) * this.flipSpeed);
                    this.color = this.scale.y > 0 ? this.colorPair.front : this.colorPair.back;
                }
            }

            function updateConfetti () {
                confettiCtx.clearRect(0, 0, container.w, container.h);

                confettiElements.forEach((c) => {
                    c.update();
                    confettiCtx.translate(c.position.x, c.position.y);
                    confettiCtx.rotate(c.rotation);
                    const width = (c.dimensions.x * c.scale.x);
                    const height = (c.dimensions.y * c.scale.y);
                    confettiCtx.fillStyle = c.color;
                    confettiCtx.fillRect(-0.5 * width, -0.5 * height, width, height);
                    confettiCtx.setTransform(1, 0, 0, 1, 0, 0)
                });

                confettiElements.forEach((c, idx) => {
                    if (c.position.y > container.h ||
                        c.position.x < -0.5 * container.x ||
                        c.position.x > 1.5 * container.x) {
                        confettiElements.splice(idx, 1)
                    }
                });
                window.requestAnimationFrame(updateConfetti);
            }

            function setupCanvas() {
                container = {
                    w: confetti.clientWidth,
                    h: confetti.clientHeight
                };
                confetti.width = container.w;
                confetti.height = container.h;
            }

            function addConfetti(e) {
                const canvasBox = confetti.getBoundingClientRect();
                if (e) {
                    clickPosition = [
                        e.clientX - canvasBox.left,
                        e.clientY - canvasBox.top
                    ];
                } else {
                    clickPosition = [
                        canvasBox.width * Math.random(),
                        canvasBox.height * Math.random()
                    ];
                }
                for (let i = 0; i < confettiParams.number; i++) {
                    confettiElements.push(new Conf())
                }
            }

            function hideConfetti() {
                confettiElements = [];
                window.cancelAnimationFrame(updateConfetti)
            }

            confettiLoop();
            function confettiLoop() {
                addConfetti();
                setTimeout(confettiLoop, 700 + Math.random() * 1700);
            }
        },
      methods: {
        async shareResult(){
            await this.$store.dispatch('setUserForLeaderboards', {id: this.getMe.id}).then(()=>{
                this.shared = true;
            })
        },
        playAudio(){
        if (this.isPlaying) {
            this.isPlaying = false;
            this.audio.pause();
            this.tl.pause();
            this.tl2.pause();
        } else {
            this.isPlaying = true;
            this.audio.play();
            this.tl.play()
            this.tl2.play();
        }
        },
        
      }
    }
    </script>
 
<template>
    <div class="end">
        <canvas id="confetti"></canvas>
        <div class="end__logo">
            <div class="end__logo__vse"></div>
            <div class="end__logo__noc"><h1>Noc Vědců</h1></div>
        </div>
        <div class="end__zena"></div>
        <div class="end__headline">Jsi v cíli, {{getMe.name}}!<span>Tohle byl tvůj poslední úkol!</span></div>
        <div class="end__money">
            <span>V peněžence máš</span>
            <div class="end__money__amount">{{getMoney.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")}},-</div>
        </div>
        <div class="end__listen">
            <div id="wrapper">
                <img id="marque" class="marque" src="../../assets/svg/zvukova_stopa.svg" width="100%" alt="">
                <img id="marque2" class="marque" src="../../assets/svg/zvukova_stopa.svg" width="100%" alt="">
            </div>
            <img id="listen_icon" class="end__listen__icon" src="../../assets/svg/icon_zvuk.svg" @click="playAudio">
        </div>
        <span class="end__thanks">Děkujeme, že jsi s&nbsp;námi hrál.</span>
        <span class="end__results">Běž svůj zůstatek porovnat s ostatními hráči.</span>
        <Transition name="slide-fade">
            <div v-if="!shared" class="end__share">
                <label class="label" for="share">Povoluji, aby se můj zůstatek sdílel s ostatními hráči na závěrečném stanovišti.
                    <input @input="shareResult" id="share" type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
        </Transition>
    </div>
</template>

