<style>

</style>
<template inheritAttrs="false">
	<LayoutAuthenticated>

		<Head :title="`Go-Easy Savings`" />
		<SectionMain>
			<SectionTitleLineWithButton :icon="mdiWalletOutline" :title="`Go-Easy Savings`" main>

				<BaseButton :href="route('goeasy_savings_main_page')" :icon="mdiArrowLeft" label="Go Back" color="warning"
					rounded-full small />
			</SectionTitleLineWithButton>
			<!-- <NotificationBar color="info" :icon="mdiMonitorCellphone">
        <b>Responsive table.</b> Collapses on mobile
      </NotificationBar> -->







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
	mdiCellphoneWireless,
	mdiAccountCog,
	mdiAccountCash,
	mdiCurrencyNgn,
	mdiPhone,
	mdiHistory,
	mdiWalletOutline,
	mdiArrowLeft,
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
const user = props.value?.auth.user;


const has_current_savings = props.value?.has_current_savings;

const errors_size = ref(0);


const useSearchBtn = mainStore.useSearchBtn;


const form = useForm({


});

Swal.fire({
	icon: 'warning',
	title: 'Note deactivation incurs forfeiting 10% of you money saved?',
	html: 'Are you sure you want to proceed?',
	showDenyButton: true,
	showCancelButton: false,
	confirmButtonText: 'Yes, Proceed',
	denyButtonText: `No, Go Back`,
	allowEscapeKey: false,
	allowOutsideClick: false,
}).then((result) => {
	/* Read more about isConfirmed, isDenied below */
	if (result.isConfirmed) {
		deactivateSaving();
	} else if (result.isDenied) {
		Inertia.visit(route('goeasy_savings_main_page'));
	}
})



const deactivateSaving = () => {

	if (!form.processing) {

		errors_size.value = 0;

		
		
		
		form.post(route('process_savings_deactivation'), {
			preserveScroll: true,
			onSuccess: (page) => {

				var response = page.props.flash.data;
				console.log(response)
				if (response.success) {

					Swal.fire({
						title: 'Success',
						icon: 'success',
						html: `You have successfully deactivated your savings plan. You have been credited.`,
						allowEscapeKey: false,
						allowOutsideClick: false,

					}).then((result) => {
						Inertia.visit(route('goeasy_savings_main_page'));

					});
				} else if (!response.already_saving) {

					Swal.fire({
						title: 'Error',
						icon: 'error',
						html: 'You dont currently a saving plan ongoing. Please choose one first.',
						allowEscapeKey: false,
						allowOutsideClick: false,
					}).then((result) => {
						Inertia.visit(route('goeasy_savings_main_page'));

					});
				}
			}, onError: (errors) => {
				var size = Object.keys(errors).length;
				errors_size.value = size;
				console.log(errors)
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: `There are ${size} form error(s). Please fix them`,
				})
			},
		});
	
		
			
		
	}
};




</script>

