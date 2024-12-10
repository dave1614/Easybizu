<template inheritAttrs="false">
	<LayoutAuthenticated>

		<Head :title="`Go-easy Savings`" />
		<SectionMain>
			<SectionTitleLineWithButton :icon="mdiWalletOutline" :title="`Go-easy Savings`" main>
				<!-- <BaseButton href="https://github.com/justboil/admin-one-vue-tailwind" target="_blank" :icon="mdiGithub"
          label="Star on GitHub" color="contrast" rounded-full small /> -->
			</SectionTitleLineWithButton>
			<!-- <NotificationBar color="info" :icon="mdiMonitorCellphone">
        <b>Responsive table.</b> Collapses on mobile
      </NotificationBar> -->


			<CardBox class="">
				<div class="font-semibold">
					<h3 class="text-center font-bold text-3xl mb-7">Go-Easy Community Multipurpose Cooperative Saving.</h3>

					
						<div v-for="(value, key) in figures" :key="key">
							<div
								
								class="grid grid-cols-12 gap-6 my-2">
								<h5 class="text-lg font-semibold capitalize col-span-6">
									<span>{{ mainStore.replaceUnderscoreWithSpace(key) }}</span>
								</h5>
								<h5 class="text-lg font-semibold capitalize text-gray-500 col-span-6">
									<span class="" >{{ mainStore.addCommas(value) }}</span>
						
								</h5>
							</div>
						
						</div>
					

				</div>




			</CardBox>






		</SectionMain>
		
	</LayoutAuthenticated>
</template>
<script setup>
import {
	mdiMonitorCellphone,
	mdiTableBorder,
	mdiTableOff,
	mdiGithub,
	mdiHospitalBuilding,
	mdiClose,
	mdiClipboardTextClock,
	mdiAccountCog,
	mdiAccountCash,
	mdiWalletOutline,
} from "@mdi/js";

import FormCheckRadioGroup from "@/components/FormCheckRadioGroup.vue";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import SectionMain from "@/components/SectionMain.vue";
import NotificationBar from "@/components/NotificationBar.vue";
import CardBox from "@/components/CardBox.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import BaseDivider from "@/components/BaseDivider.vue";
import BaseButton from "@/components/BaseButton.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import BaseLevel from "@/components/BaseLevel.vue";
import CardBoxComponentEmpty from "@/components/CardBoxComponentEmpty.vue";
import CardBoxModal from "@/components/CardBoxModal.vue";
import FloatingActionButton from "@/components/FloatingActionButton.vue";
import FormLoaderDark from '@/Loaders/form_loader_dark.gif'
import FormLoaderLight from '@/Loaders/form_loader_light.gif'

import { useMainStore } from "@/stores/main";
import { useForm, usePage, Head, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import { computed, ref, reactive, watch } from 'vue'
import axios from "axios";
import _ from 'lodash';

const page = usePage();
const mainStore = useMainStore();

const btn_hovered = ref(false);

// const hasTermsAndPrivacyPolicyFeature = computed(() => page.props.value?.jetstream?.hasTermsAndPrivacyPolicyFeature)
const props = page.props;
const user = props.value?.user;
const figures = props.value?.figures;


const useSearchBtn = mainStore.useSearchBtn;

</script>

