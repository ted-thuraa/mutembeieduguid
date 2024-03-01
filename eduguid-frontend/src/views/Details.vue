<template>
    <div class="mx-40 mt-20 mb-20">
        <div>
            <h1 class="text-gray-600 text-lg font-bold">
                Fill out the following to proceed
            </h1>
        </div>
        <form @submit.prevent="saveDetails">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">
                        Personal Information
                    </h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        This information will be used to recommend appropriate
                        resources.
                    </p>

                    <div
                        class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                    >
                        <div class="sm:col-span-3">
                            <label
                                for="first-name"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >First name</label
                            >
                            <div class="mt-2">
                                <input
                                    v-model="details.firstname"
                                    type="text"
                                    name="first-name"
                                    id="first-name"
                                    autocomplete="given-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label
                                for="last-name"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >Last name</label
                            >
                            <div class="mt-2">
                                <input
                                    v-model="details.lastname"
                                    type="text"
                                    name="last-name"
                                    id="last-name"
                                    autocomplete="family-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />
                            </div>
                        </div>

                        <div class="sm:col-span-4">
                            <label
                                for="email"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >Email address</label
                            >
                            <div class="mt-2">
                                <input
                                    v-model="details.email"
                                    id="email"
                                    name="email"
                                    type="email"
                                    autocomplete="email"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">
                        Other information
                    </h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        We'll use this information to recommend respective
                        resources.
                    </p>

                    <div
                        class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                    >
                        <div class="sm:col-span-3">
                            <label
                                for="institution"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >Institution</label
                            >
                            <div class="mt-2">
                                <input
                                    v-model="details.institution"
                                    type="text"
                                    name="institution"
                                    id="institution"
                                    autocomplete="given-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label
                                for="course"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >Course</label
                            >
                            <div class="mt-2">
                                <input
                                    v-model="details.course"
                                    type="text"
                                    name="course"
                                    id="course"
                                    autocomplete="family-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label
                                for="year"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >Year</label
                            >
                            <div class="mt-2">
                                <select
                                    v-model="details.study_year"
                                    id="year"
                                    name="year"
                                    autocomplete="country-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                >
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <!-- <button
                    type="button"
                    class="text-sm font-semibold leading-6 text-gray-900"
                >
                    Cancel
                </button> -->
                <button
                    type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    Save
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, watch, computed, onMounted, isProxy, toRaw, nextTick } from "vue";
import { useStore } from "vuex";
import { useRoute, useRouter } from "vue-router";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";

const store = useStore();
const route = useRoute();
const router = useRouter();

const details = {
    firstname: "",
    lastname: "",
    institution: "",
    course: "",
    study_year: "",
};

const saveDetails = async (ev) => {
    //loading.value = true;
    //errorMsg.value = null;
    ev.preventDefault();
    //await userStore.getTokens();
    await store
        .dispatch("saveDetails", details)
        .then((data) => {
            console.log(data);
            //loading.value = false;
            router.push({
                name: "UserDashboard",
            });
        })
        .catch((error) => {
            console.log(error);
            //loading.value = false;
            //if (error.response.data.errors) {
            //    errorMsg.value = error.response.data.message;
            //} else {
            //    errorMsg.value = error.response.data.error;
            //}
        });
};

onMounted(async () => {
    //loading.value = true;
    await store.dispatch("getUser");

    if (store.state.user.isAdmin) {
        router.push({
            name: "AdminDash",
        });
    }
    //loading.value = false;
});
</script>

<style></style>
