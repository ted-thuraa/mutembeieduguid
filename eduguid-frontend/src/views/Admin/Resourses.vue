<template>
    <div class="relative mt-6 overflow-x-auto shadow-md sm:rounded-lg">
        <!-- dialog -->
        <div>
            <div class="my-14 z-10 inset-0 flex items-center justify-center">
                <button
                    type="button"
                    @click="openModal"
                    class="rounded-md bg-indigo-700 px-4 py-2 text-sm font-medium text-white hover:bg-indigo/30 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
                >
                    Add new Resource
                </button>
            </div>
            <TransitionRoot appear :show="isOpen" as="template">
                <Dialog as="div" @close="closeModal" class="relative z-80">
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0"
                        enter-to="opacity-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100"
                        leave-to="opacity-0"
                    >
                        <div class="fixed z-50 inset-0 bg-black/25" />
                    </TransitionChild>

                    <div class="fixed z-[60] inset-0 overflow-y-auto">
                        <div
                            class="flex min-h-full items-center justify-center p-4 text-center"
                        >
                            <TransitionChild
                                as="template"
                                enter="duration-300 ease-out"
                                enter-from="opacity-0 scale-95"
                                enter-to="opacity-100 scale-100"
                                leave="duration-200 ease-in"
                                leave-from="opacity-100 scale-100"
                                leave-to="opacity-0 scale-95"
                            >
                                <DialogPanel
                                    class="w-full max-w-[60rem] transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                                >
                                    <div class="mt- flex justify-end">
                                        <button
                                            type="button"
                                            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                            @click="closeModal"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="w-6 h-6"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12"
                                                />
                                            </svg>
                                        </button>
                                    </div>
                                    <DialogTitle
                                        as="h3"
                                        class="w-full text-center font-bold text-xl leading-6 text-gray-900"
                                    >
                                        Resource details.
                                    </DialogTitle>
                                    <div class="mx-40 mt-20 mb-20">
                                        <form @submit.prevent="saveResource">
                                            <div class="space-y-12">
                                                <div
                                                    class="border-b border-gray-900/10 pb-12"
                                                >
                                                    <div
                                                        class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                                                    >
                                                        <div
                                                            class="sm:col-span-3"
                                                        >
                                                            <label
                                                                for="title"
                                                                class="block text-sm font-medium leading-6 text-gray-900"
                                                                >Title</label
                                                            >
                                                            <div class="mt-2">
                                                                <input
                                                                    v-model="
                                                                        resourceDetails.title
                                                                    "
                                                                    type="text"
                                                                    name="title"
                                                                    id="title"
                                                                    autocomplete="given-name"
                                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                                />
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="sm:col-span-3"
                                                        >
                                                            <label
                                                                for="type"
                                                                class="block text-sm font-medium leading-6 text-gray-900"
                                                                >Type</label
                                                            >
                                                            <div class="mt-2">
                                                                <select
                                                                    v-model="
                                                                        resourceDetails.type
                                                                    "
                                                                    id="type"
                                                                    name="type"
                                                                    autocomplete="family-name"
                                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                                                >
                                                                    <option>
                                                                        Book
                                                                    </option>
                                                                    <option>
                                                                        Article
                                                                    </option>
                                                                    <option>
                                                                        Video
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:col-span-3"
                                                        >
                                                            <label
                                                                for="url"
                                                                class="block text-sm font-medium leading-6 text-gray-900"
                                                                >Resource
                                                                link</label
                                                            >
                                                            <div class="mt-2">
                                                                <input
                                                                    v-model="
                                                                        resourceDetails.url
                                                                    "
                                                                    type="text"
                                                                    name="url"
                                                                    id="url"
                                                                    autocomplete="family-name"
                                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                                />
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="sm:col-span-3"
                                                        >
                                                            <label
                                                                for="year"
                                                                class="block text-sm font-medium leading-6 text-gray-900"
                                                                >curriculum
                                                                year</label
                                                            >
                                                            <div class="mt-2">
                                                                <input
                                                                    v-model="
                                                                        resourceDetails.year
                                                                    "
                                                                    type="number"
                                                                    name="year"
                                                                    id="year"
                                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                                />
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="sm:col-span-3"
                                                        >
                                                            <label
                                                                for="unit"
                                                                class="block text-sm font-medium leading-6 text-gray-900"
                                                                >Resource
                                                                unit</label
                                                            >
                                                            <div class="mt-2">
                                                                <input
                                                                    v-model="
                                                                        resourceDetails.unit
                                                                    "
                                                                    type="text"
                                                                    name="unit"
                                                                    id="unit"
                                                                    autocomplete="family-name"
                                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:col-span-3"
                                                        >
                                                            <label
                                                                for="cate"
                                                                class="block text-sm font-medium leading-6 text-gray-900"
                                                                >Category</label
                                                            >
                                                            <div class="mt-2">
                                                                <select
                                                                    v-model="
                                                                        resourceDetails.category
                                                                    "
                                                                    id="category"
                                                                    name="category"
                                                                    autocomplete="family-name"
                                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                                                >
                                                                    <option>
                                                                        Architecture
                                                                    </option>
                                                                    <option>
                                                                        Nursing
                                                                    </option>
                                                                    <option>
                                                                        Software
                                                                        Engineering
                                                                    </option>
                                                                    <option>
                                                                        Mechanical
                                                                        Engineering
                                                                    </option>
                                                                    <option>
                                                                        Law
                                                                    </option>
                                                                    <option>
                                                                        Computer
                                                                        Science
                                                                    </option>
                                                                    <option>
                                                                        Econimcs
                                                                        and
                                                                        Statistics
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="sm:col-span-6"
                                                        >
                                                            <label
                                                                for="description"
                                                                class="block mb-2 text-sm font-medium text-gray-900"
                                                                >description</label
                                                            >
                                                            <textarea
                                                                v-model="
                                                                    resourceDetails.description
                                                                "
                                                                id="description"
                                                                rows="4"
                                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                                                placeholder="Write description here..."
                                                            ></textarea>
                                                        </div>

                                                        <div
                                                            class="sm:col-span-6"
                                                        >
                                                            <label
                                                                class="block text-sm font-medium text-gray-700"
                                                            >
                                                                Thumbnail image
                                                            </label>
                                                            <div
                                                                class="mt-1 w-full flex items-center"
                                                            >
                                                                <img
                                                                    v-if="
                                                                        thumbnail_url
                                                                    "
                                                                    :src="
                                                                        thumbnail_url
                                                                    "
                                                                    :alt="
                                                                        resourceDetails.title
                                                                    "
                                                                    class="w-64 h-48 object-cover"
                                                                />
                                                                <span
                                                                    v-else
                                                                    class="flex items-center justify-center h-[50%] w-[50%] overflow-hidden bg-gray-100"
                                                                >
                                                                    <svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none"
                                                                        viewBox="0 0 24 24"
                                                                        stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                        class="w-[80%] h-[80%] text-gray-300"
                                                                    >
                                                                        <path
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"
                                                                        />
                                                                    </svg>
                                                                </span>
                                                                <button
                                                                    type="button"
                                                                    class="relative overflow-hidden ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                                >
                                                                    <input
                                                                        type="file"
                                                                        @change="
                                                                            onImageChange
                                                                        "
                                                                        class="absolute left-0 top-0 right-0 bottom-0 opacity-0 cursor-pointer"
                                                                    />
                                                                    Change
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="mt-6 flex items-center justify-end gap-x-6"
                                            >
                                                <button
                                                    type="submit"
                                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                                >
                                                    Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </Dialog>
            </TransitionRoot>
        </div>
        <!-- dialog -->
        <div
            class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white"
        >
            <div>
                <button
                    id="dropdownActionButton"
                    data-dropdown-toggle="dropdownAction"
                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"
                    type="button"
                >
                    <span class="sr-only">Action button</span>
                    Action
                    <svg
                        class="w-2.5 h-2.5 ms-2.5"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 10 6"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 4 4 4-4"
                        />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div
                    id="dropdownAction"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44"
                >
                    <ul
                        class="py-1 text-sm text-gray-700"
                        aria-labelledby="dropdownActionButton"
                    >
                        <li>
                            <a
                                href="#"
                                class="block px-4 py-2 hover:bg-gray-100"
                                >Reward</a
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="block px-4 py-2 hover:bg-gray-100"
                                >Promote</a
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="block px-4 py-2 hover:bg-gray-100"
                                >Activate account</a
                            >
                        </li>
                    </ul>
                    <div class="py-1">
                        <a
                            href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            >Delete User</a
                        >
                    </div>
                </div>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div
                    class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none"
                >
                    <svg
                        class="w-4 h-4 text-gray-500"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 20 20"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                        />
                    </svg>
                </div>
                <input
                    type="text"
                    id="table-search-users"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Search for users"
                />
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500"
            >
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-16 py-3">
                            <span class="sr-only">Image</span>
                        </th>
                        <th scope="col" class="px-6 py-3">Title</th>
                        <th scope="col" class="px-6 py-3">Type</th>
                        <th scope="col" class="px-6 py-3">category</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="resource in store.state.resources.data"
                        :key="resource"
                        class="bg-white border-b"
                    >
                        <td class="p-4">
                            <img
                                :src="resource.thumbnailimage"
                                class="w-16 md:w-32 max-w-full max-h-full"
                                :alt="resource.title"
                            />
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900">
                            {{ resource.title }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-900">
                            {{ resource.type }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900">
                            {{ resource.category }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900">
                            N/A
                        </td>
                        <td
                            class="px-6 py-4 flex flex-row items-center justify-center"
                        >
                            <a
                                @click="editResource(resource)"
                                class="font-medium text-indigo-600 hover:underline pl-2"
                                ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                                    />
                                </svg>
                            </a>
                            <a
                                @click="deleteResource(resource)"
                                class="font-medium text-red-600 hover:underline"
                                ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                    />
                                </svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { useRouter, useRoute } from "vue-router";
import { ref, watch, onMounted } from "vue";
import store from "../../store";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";

let thumbnail_url = ref(null);

const resourceDetails = {
    id: null,
    title: "",
    type: "",
    category: "",
    description: "",
    year: "",
    unit: "",
    thumbnailimage: null,
    url: "",
};

onMounted(async () => {
    //loading.value = true;
    await store.dispatch("getUser");
    await store.dispatch("getResources");
});

function onImageChange(ev) {
    //get the first one
    const file = ev.target.files[0];

    //file preview
    const reader = new FileReader();
    reader.onload = () => {
        //field tosend to backend
        resourceDetails.thumbnailimage = reader.result;

        //field for the preview
        thumbnail_url.value = reader.result;
    };
    reader.readAsDataURL(file);
}

function editResource(resource) {
    resourceDetails.id = resource.id;
    resourceDetails.title = resource.title;
    resourceDetails.type = resource.type;
    resourceDetails.category = resource.category;
    resourceDetails.description = resource.description;
    resourceDetails.year = resource.year;
    resourceDetails.unit = resource.unit;
    resourceDetails.url = resource.url;
    isOpen.value = true;
}
const saveResource = async (ev) => {
    //loading.value = true;
    //errorMsg.value = null;
    ev.preventDefault();
    //await userStore.getTokens();
    if (resourceDetails && resourceDetails.id) {
        try {
            const data = await store.dispatch("updateResource", {
                resourceDetails,
                id: resourceDetails.id,
            });
            console.log(data);
            store.dispatch("getResources");
            closeModal();
        } catch (error) {
            console.log(error);
        }
    } else {
        try {
            const data = await store.dispatch(
                "createNewResource",
                resourceDetails
            );
            console.log(data);
            store.dispatch("getResources");
            closeModal();
        } catch (error) {
            console.log(error);
        }
    }
};

function deleteResource(resource) {
    if (confirm(`Are you sure, this cant be undone!`)) {
        store.dispatch("deleteResource", resource.id).then(() => {
            closeModal();
        });
    }
}

const isOpen = ref(false);

function closeModal() {
    isOpen.value = false;
    resourceDetails.title = "";
    resourceDetails.type = "";
    resourceDetails.category = "";
    resourceDetails.description = "";
    resourceDetails.year = "";
    resourceDetails.unit = "";
    resourceDetails.url = "";
}
function openModal() {
    isOpen.value = true;
}
</script>

<style lang="scss" scoped></style>
