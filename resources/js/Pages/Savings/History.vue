<template inheritAttrs="false">
	<LayoutAuthenticated>

		<Head title="Your Savings" />
		<SectionMain>
			<SectionTitleLineWithButton :icon="mdiClipboardTextClock" title="Your Savings" main>
				<!-- <BaseButton href="https://github.com/justboil/admin-one-vue-tailwind" target="_blank" :icon="mdiGithub"
          label="Star on GitHub" color="contrast" rounded-full small /> -->
			</SectionTitleLineWithButton>
			<!-- <NotificationBar color="info" :icon="mdiMonitorCellphone">
        <b>Responsive table.</b> Collapses on mobile
      </NotificationBar> -->

			<!-- <CardBox v-if="useSearchBtn" form @submit.prevent="submitFilterForm" class=""> -->
			<CardBox isForm @submit.prevent="submitFilterForm" class="">
				<div class="sm:grid sm:grid-cols-12 sm:gap-6">
					<FormField class="sm:col-span-4" label="Length: ">
						<FormControl v-model="form.length" :options="lengthOptions" />
					</FormField>
					<FormField class="sm:col-span-4" label="Amount">
						<FormControl v-model="form.amount" type="number" step="any" />
					</FormField>
					<FormField class="sm:col-span-4" label="Frequency">
						<FormControl v-model="form.frequency" type="text" />
					</FormField>
					<FormField class="sm:col-span-4" label="Duration">
						<FormControl v-model="form.duration" type="text" />
					</FormField>

					<FormField class="sm:col-span-4" label="Status" wrap-body>
						<FormCheckRadioGroup v-model="form.status" name="sample-radio" type="radio"
							:options="statusOptions" />
					</FormField>
					
					<FormField class="sm:col-span-4" label="Projected End Date">
						<FormControl v-model="form.projected_end_date" type="date" />
					</FormField>
					
					<FormField class="sm:col-span-4" label="Start Date">
						<FormControl v-model="form.start_date" type="date" />
					</FormField>

					<FormField class="sm:col-span-4" label="End Date">
						<FormControl v-model="form.end_date" type="date" />
					</FormField>


				</div>
				<BaseButtons>
					<BaseButton v-if="useSearchBtn" type="submit" color="info" label="Filter" class="px-9 mb-8" />
					<BaseButton @click="clearFilterForm" type="reset" color="info" outline label="Clear" :icon="mdiClose"
						class="px-9 mb-8" />
				</BaseButtons>
				<BaseDivider />
			</CardBox>

			<CardBox class="mb-6" has-table>
				
				<div v-if="savings.data.length > 0" class="">
					<p class="text-emerald-600 font-bold text-sm ml-3">Click to view more details</p>
					<table>
						<thead>
							<tr>

								<th></th>
								<th>Status</th>
								<th>Amount (₦)</th>
								<th>Frequency</th>
								<th>Duration</th>
								<th>Start Date</th>
								<th>Projected End Date</th>
								

							</tr>
						</thead>
						<tbody>
							<tr class="cursor-pointer" @click="performMoreFunctions(row)" v-for="(row, index) in savings.data" :key="row.id">

								<!-- <td>{{ row.index }}. </td> -->

								<td v-html="`${(index + 1) + ((savings.current_page - 1) * form.length)}.`"></td>
								<td data-label="Status" class="capitalize">
									<p v-if="row.disbursed == 0">pending</p>
									<p v-if="row.disbursed == 1 && row.cause_of_disbursement != 'user deactivation'">disbursed</p>
									<p v-if="row.disbursed == 1 && row.cause_of_disbursement == 'user deactivation'">deactivated</p>
								</td>
								<td
									data-label="Amount"
									v-html="mainStore.addCommas(row.amount)">

								</td>
								<td
									data-label="Frequency"
									v-html="row.frequency_label">

								</td>
								<td
									data-label="Duration"
									v-html="row.duration_label">

								</td>
								<td data-label="Start Date" v-html="`${row.start_date}`">

								</td>
								<td data-label="Projected End Date" v-html="`${row.end_of_savings_date}`">
								
								</td>
								

							</tr>
						</tbody>
					</table>
					<div class="p-3 lg:px-6 border-t border-gray-100 dark:border-slate-800">
						<BaseLevel>
							<BaseButtons>
								<BaseButton v-for="page in savings.links" :key="page" :active="page.active" :label="page.label"
									:color="page.active ? 'lightDark' : 'whiteDark'" small @click="currentPage = page"
									:href="page.url != null ? page.url : ''" :disabled="page.url === null" />
							</BaseButtons>
							<small>Page {{ savings.current_page }} of {{ savings.last_page }}</small>
						</BaseLevel>
					</div>
				</div>
			</CardBox>

			<CardBoxModal v-model="showMoreFunctionsModal" button="danger" buttonLabel="Close"
				:title="`Choose Action`">
				<div class="">
					
					<div class="overflow-x-hidden max-h-[350px]">
						<table class="table table-bordered mt-4">
							<tbody>
			
								<tr >
									<td>1.</td>
									<td><Link target="_blank" :href="route('view_saving_details', saving_id)">View more details</Link></td>
									
								</tr>

								<tr>
									<td>2.</td>
									<td>
										<Link target="_blank" :href="route('savings_debit_history', saving_id)">View debit history</Link>
									</td>
								
								</tr>

								<tr class="text-red-500" v-if="disbursed == 0">
									<td>3.</td>
									<td><Link  target="_blank" :href="route('deactivate_saving_plan')">Deactivate this plan</Link></td>
									
								</tr>

								
								
							</tbody>
						</table>
					</div>
			
					
				</div>
			
			</CardBoxModal>
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
	mdiClipboardTextClock
} from "@mdi/js";

import CardBoxModal from "@/components/CardBoxModal.vue";
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
import { useMainStore } from "@/stores/main";
import { useForm, usePage, Head, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import { computed, ref, reactive, watch } from 'vue'
import _ from 'lodash';

const page = usePage();
const mainStore = useMainStore();

// const hasTermsAndPrivacyPolicyFeature = computed(() => page.props.value?.jetstream?.hasTermsAndPrivacyPolicyFeature)
const props = page.props;
const savings = props.value?.savings;
const useSearchBtn = mainStore.useSearchBtn;
console.log(savings)

const lengthOptions = ref([
	10,
	20,
	50,
	100
]);

const disbursed = ref(0);
const showMoreFunctionsModal = ref(false);
const saving_id = ref(0);

const statusOptions = ref({ all: 'all', pending: 'pending', disbursed: 'disbursed', deactivated: 'deactivated' });

const form = useForm({
	length: props.value?.length,
	frequency: props.value?.frequency,
	duration: props.value?.duration,
	amount: props.value?.amount,
	status: props.value?.status,
	date: props.value?.date,
	projected_end_date: props.value?.projected_end_date,
	start_date: props.value?.start_date,
	end_date: props.value?.end_date,

})
// console.log(form)

const clearFilterForm = () => {
	form.length = 10
	form.frequency = null
	form.duration = null
	form.amount = null
	form.status = statusOptions.value.all
	form.date = null
	form.projected_end_date = null
	form.start_date = null
	form.end_date = null


	// console.log(form)
}



const submitFilterForm = () => {
	console.log('test')
	let query = _.pickBy(form);
	let queryRoute = route('savings_history', Object.keys(query).length ? query : {
		remember: 'forget'
	});


	Inertia.get(queryRoute, {}, {
		// preserveState: true, 
		preserveScroll: true

	});
}

watch(form,
	_.throttle(() => {
		if (useSearchBtn) { return }
		submitFilterForm();
	}, 200), {
	deep: true
}
);


const performMoreFunctions = (row) => {
	disbursed.value = row.disbursed;
	saving_id.value = row.id;
	showMoreFunctionsModal.value = true;
};
</script>

