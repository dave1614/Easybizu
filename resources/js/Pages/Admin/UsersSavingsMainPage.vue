<template inheritAttrs="false">
	<LayoutAuthenticated>

		<Head :title="`${user.name}'s Go-easy Savings`" />
		<SectionMain>
			<SectionTitleLineWithButton :icon="mdiWalletOutline" :title="`${user.name}'s Go-easy Savings`" main>
				<!-- <BaseButton href="https://github.com/justboil/admin-one-vue-tailwind" target="_blank" :icon="mdiGithub"
          label="Star on GitHub" color="contrast" rounded-full small /> -->
			</SectionTitleLineWithButton>
			<!-- <NotificationBar color="info" :icon="mdiMonitorCellphone">
        <b>Responsive table.</b> Collapses on mobile
      </NotificationBar> -->


			<CardBox class="">
				<div class="font-semibold">
					<h3 class="text-center font-bold text-3xl mb-7">Go-Easy Community Multipurpose Cooperative Saving.</h3>
					
					<h5 class="font-bold text-2xl text-center my-6">Choose Action</h5>
			
					<CardBox class="mb-6" has-table>
			
						<div v-if="filtered_params.length > 0" class="">
							<table>
			
								<tbody>
									
									<tr @click="Inertia.visit(param.url)" class="cursor-pointer" :class="param.color == '' ? '' : param.color"
										v-for="(param, index) in filtered_params" :key="index">
										<!-- <td>{{ param.num }}. </td> -->
										<td class="capitalize">{{ param.name }}</td>
									</tr>
			
								</tbody>
							</table>
			
						</div>
					</CardBox>
			
				</div>
			
			
			
			
			</CardBox>

			
			



		</SectionMain>
		<FloatingActionButton :title="'Go Back'"
			@click="Inertia.visit(route('view_members_list') + '?length=10&name=' + user.name + '&isDirty=true&__rememberable=true')">

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
const has_current_savings = props.value?.has_current_savings;
const saving_id = props.value?.saving_id;

console.log(saving_id)


const useSearchBtn = mainStore.useSearchBtn;


const table_params = ref([
	
	{
		'id': 2,
		'num': 1,
		'name': 'View current saving details',
		'url': route('view_users_saving_details', [user.id, saving_id]),
		'color': '',
	},
	{
		'id': 3,
		'num': 2,
		'name': 'View Savings History',
		'url': route('users_savings_history',user.id),
		'color': '',
	},
	{
		'id': 4,
		'num': 3,
		'name': 'Auto Withdrawal History',
		'url': route('users_savings_auto_withd_history',user.id),
		'color': '',
	},
	
]);

const filtered_params = ref([]);



const getFilteredTableParams = () => {
	filtered_params.value = table_params.value;
	// console.log(filtered_params.value)
	// let index = (has_current_savings) ? 0 : 1;

	// filtered_params.value.splice(index,1);
	if (has_current_savings) {
		// filtered_params.value.splice(0, 1);
	} else {
		filtered_params.value.splice(0, 1);
		filtered_params.value.splice(3, 1);
	}

}



getFilteredTableParams()






</script>

