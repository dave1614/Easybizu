<style>
@import url("https://rsms.me/inter/inter.css");

html {
  font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI",
    Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif,
    "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol",
    "Noto Color Emoji";
}

.gradient {
  /* background-image: linear-gradient(-225deg, #cbbacc 0%, #2580b3 100%); */
  background-image: linear-gradient(to right bottom, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/public/img/pexels-ibrahim-boran-613021 (2).jpg');
  /* background-size: contain; */
}

/* button,
.gradient2 {
  background-color: #f39f86;
  background-image: linear-gradient(315deg, #f39f86 0%, #f9d976 74%);
  
} */

/* Browser mockup code
 * Contribute: https://gist.github.com/jarthod/8719db9fef8deb937f4f
 * Live example: https://updown.io
 */

.browser-mockup {
  border-top: 2em solid rgba(230, 230, 230, 0.7);
  position: relative;
  height: 60vh;
}

.browser-mockup:before {
  display: block;
  position: absolute;
  content: "";
  top: -1.25em;
  left: 1em;
  width: 0.5em;
  height: 0.5em;
  border-radius: 50%;
  background-color: #f44;
  box-shadow: 0 0 0 2px #f44, 1.5em 0 0 2px #9b3, 3em 0 0 2px #fb5;
}

.browser-mockup>* {
  display: block;
}

.small-banner{
  height: 270px;
  background-image: linear-gradient(to right bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url('/public/img/about-us.jpg') ;
  background-size: 100% 100%;
    background-repeat: no-repeat;
    background-position: left top;

  
}

/* Custom code for the demo */
</style>

<template>
  <div class=" leading-relaxed tracking-wide flex flex-col">
    <!--Nav-->
    <MainPageNav selectedPage="about_us"/>

    <div class="small-banner">

    </div>

   

    <section class="bg-white border-b py-1 px-4">
      <div class="container mx-auto flex flex-wrap items-center justify-between pb-12">
        <h2 class="text-4xl w-full my-4 font-black leading-tight text-center text-gray-800 lg:mt-8">
          About Us
        </h2>
        <div class="w-full mb-12">
          <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
    
        <div class="text-gray-600 mb-8 font-semibold text-lg">
          <p class="my-4 mx-2">Go-Easybiz is a Cooperative Community of Telecoms Users.
          It's a community that help it's members earn passive income easily and work in improving it's members Financial
          standard. <br><br>
          We encourage members savings and strive to enhance their micro businesses.
          Using information sharing and networking, we increase wealth creation, create pool of business financing and
          developmental matters.<br><br>
          
          We give access to Loans and business development services.
          We offer enterprenurial information, advice, referral, enterprenurial master class and incubation initiatives.<br><br>
          
          As a Telecoms users Community, members can conveniently buy airtime, print recharge cards, buy cheap Internet data, and
          get amazing chargeback, refer or not and earn enormously weekly.
          You can also renew your dstv, gotv, startimes, pay electricity bills, pay smile internet data, send bulk SMS and earn.
          
          </p>

          <div class="mt-9 mb-5">
            <h5 class="font-bold text-xl">MEMBERS BENEFITS.</h5>
            <ul class="font-[400] my-3 text-lg">
              <li class="my-4">
                <span class="font-bold">* Savings opportunity</span>
                <p class="font-[100] text-lg">If you save money, money will save you
                You can chose to save either Daily, Weekly, or monthly withing your choices duration and get 2% at the end of your
                savings plan.</p>
              </li>
              
              <li class="my-4">
                <span class="font-bold">* Get Loan</span>
                <p class="font-[100] text-lg">Members can easily get Loan either base of their weekly earnings or based on their savings power with just a click away.</p>
              </li>

              <li class="my-4">
                <span class="font-bold">* Earnings</span>
                <p class="font-[100] text-lg">Members get sponsor earning of N700 when they invite others, placement earnings, deposit earnings, purchase
                earnings(when either them, their upteam or down team members make services purchases).</p>
              </li>

              <li class="my-4">
                <span class="font-bold">* Airtime Purchase (VTU)</span>
                <p class="font-[100] text-lg">Enjoy much discount on airtime purchase on our platform.
                We offer VTU airtime for MTN, Glo, Airtel and 9mobile.
                
                <a class="text-sm underline text-blue-500" target="_blank" :href="route('airtime_topup')">Click to Purchase</a></p>
              </li>
              
              <li class="my-4">
                <span class="font-bold">* Cable TV</span>
                <p class="font-[100] text-lg">Subscribe your Cable TV (DSTv, GOTv & Startimes) at the cheapest price and get instant activation.
                Get discount while doing so.

                <a class="text-sm underline text-blue-500" target="_blank" :href="route('cable_tv')">Click to Subscribe</a></p>
              </li>

              <li class="my-4">
                <span class="font-bold">* Print Recharge Cards Online</span>
                <p class="font-[100] text-lg">Print recharge card online that works for MTN, Glo, Airtel, 9mobile.
                Our universal pin works for effectively for all networks.
                
              <a class="text-sm underline text-blue-500" target="_blank" :href="route('airtime_topup')">Click to Print recharge card</a></p>
              </li>
              
            </ul>
          </div>

          <div class="my-4 mt-9">
            <!-- <h5 class="font-bold text-xl">Partnership at what Cost ?</h5> -->
            <p class="font-[400] ml-3">Just N1,100 membership fee.</p>
          </div>

          <div class="my-4 mt-9">
            
            <p class="">Join Go-Easybiz.
            ...Easy! Amazing! Reliable!</p>
          </div>
          
        </div>
      </div>
    </section>

    <!--Footer-->
    <MainFooter />


  </div>

</template>

<script setup>
import MainFooter from "@/components/MainFooter.vue";
import MainPageNav from "@/components/MainPageNav.vue";
import { Inertia } from '@inertiajs/inertia';
import { useMainStore } from "@/stores/main";

const mainStore = useMainStore();
</script>