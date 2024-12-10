<template inheritAttrs="false">
	<LayoutAuthenticated>

		<Head :title="`${user.name}'s Saving Details`" />
		<SectionMain>
			<SectionTitleLineWithButton :icon="mdiClipboardTextClock" :title="`${user.name}'s Saving Details`" main>
				<!-- <BaseButton href="https://github.com/justboil/admin-one-vue-tailwind" target="_blank" :icon="mdiGithub"
          label="Star on GitHub" color="contrast" rounded-full small /> -->
			</SectionTitleLineWithButton>
			<!-- <NotificationBar color="info" :icon="mdiMonitorCellphone">
        <b>Responsive table.</b> Collapses on mobile
      </NotificationBar> -->


			<CardBox class="mb-6">
			
				<div class="">
			
					<div class="mb-7">
						<div v-for="(value, key) in saving" :key="key">
							<div
								v-if="key != 'id' && key != 'user_id' && key != 'savings_frequency_id' && key != 'savings_duration_id' && key != 'created_at' && key != 'updated_at'"
								class="grid grid-cols-12 gap-6 my-2">
								<h5 class="text-lg font-semibold capitalize col-span-6">
									<span>{{ mainStore.replaceUnderscoreWithSpace(key) }}</span>
								</h5>
								<h5 class="text-lg font-semibold capitalize text-gray-500 col-span-6">
									<span class="" v-if="key == 'defaulted' || key == 'disbursed'">{{ Boolean(Number(value)) }}</span>
			
									<span v-else>{{ value }}</span>
								</h5>
							</div>
			
						</div>
					</div>
			
					<BaseButton target="_blank" :href="route('users_savings_debit_history',[user.id, saving.id])" color="success"
						label="View Debit History" class="px-9 mt-8" />
				</div>
			</CardBox>
			


		</SectionMain>
		<FloatingActionButton :title="'Go Back'"
			@click="Inertia.visit(route('users_goeasy_savings_main_page', user.id))">

			<i class="fas fa-arrow-left" style="font-size: 25px; color: #fff;"></i>
		</FloatingActionButton>
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

const useSearchBtn = mainStore.useSearchBtn;
const saving = props.value?.saving;

// console.log(saving)



</script>

