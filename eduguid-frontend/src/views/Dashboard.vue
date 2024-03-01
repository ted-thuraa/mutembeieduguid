<template>
    <div class="bg-white">
        <div>
            <!-- Mobile filter dialog -->
            <TransitionRoot as="template" :show="mobileFiltersOpen">
                <Dialog
                    as="div"
                    class="relative z-40 lg:hidden"
                    @close="mobileFiltersOpen = false"
                >
                    <TransitionChild
                        as="template"
                        enter="transition-opacity ease-linear duration-300"
                        enter-from="opacity-0"
                        enter-to="opacity-100"
                        leave="transition-opacity ease-linear duration-300"
                        leave-from="opacity-100"
                        leave-to="opacity-0"
                    >
                        <div class="fixed inset-0 bg-black bg-opacity-25" />
                    </TransitionChild>

                    <div class="fixed inset-0 z-40 flex">
                        <TransitionChild
                            as="template"
                            enter="transition ease-in-out duration-300 transform"
                            enter-from="translate-x-full"
                            enter-to="translate-x-0"
                            leave="transition ease-in-out duration-300 transform"
                            leave-from="translate-x-0"
                            leave-to="translate-x-full"
                        >
                            <DialogPanel
                                class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl"
                            >
                                <div
                                    class="flex items-center justify-between px-4"
                                >
                                    <h2
                                        class="text-lg font-medium text-gray-900"
                                    >
                                        Filters
                                    </h2>
                                    <button
                                        type="button"
                                        class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400"
                                        @click="mobileFiltersOpen = false"
                                    >
                                        <span class="sr-only">Close menu</span>
                                        <XMarkIcon
                                            class="h-6 w-6"
                                            aria-hidden="true"
                                        />
                                    </button>
                                </div>

                                <!-- Filters -->
                                <form class="mt-4 border-t border-gray-200">
                                    <h3 class="sr-only">Categories</h3>
                                    <ul
                                        role="list"
                                        class="px-2 py-3 font-medium text-gray-900"
                                    >
                                        <li
                                            v-for="category in subCategories"
                                            :key="category.name"
                                        >
                                            <a
                                                :href="category.href"
                                                class="block px-2 py-3"
                                                >{{ category.name }}</a
                                            >
                                        </li>
                                    </ul>

                                    <Disclosure
                                        as="div"
                                        v-for="section in filters"
                                        :key="section.id"
                                        class="border-t border-gray-200 px-4 py-6"
                                        v-slot="{ open }"
                                    >
                                        <h3 class="-mx-2 -my-3 flow-root">
                                            <DisclosureButton
                                                class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"
                                            >
                                                <span
                                                    class="font-medium text-gray-900"
                                                    >{{ section.name }}</span
                                                >
                                                <span
                                                    class="ml-6 flex items-center"
                                                >
                                                    <PlusIcon
                                                        v-if="!open"
                                                        class="h-5 w-5"
                                                        aria-hidden="true"
                                                    />
                                                    <MinusIcon
                                                        v-else
                                                        class="h-5 w-5"
                                                        aria-hidden="true"
                                                    />
                                                </span>
                                            </DisclosureButton>
                                        </h3>
                                        <DisclosurePanel class="pt-6">
                                            <div class="space-y-6">
                                                <div
                                                    v-for="(
                                                        option, optionIdx
                                                    ) in section.options"
                                                    :key="option.value"
                                                    class="flex items-center"
                                                >
                                                    <input
                                                        :id="`filter-mobile-${section.id}-${optionIdx}`"
                                                        :name="`${section.id}[]`"
                                                        :value="option.value"
                                                        type="checkbox"
                                                        :checked="
                                                            option.checked
                                                        "
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                    />
                                                    <label
                                                        :for="`filter-mobile-${section.id}-${optionIdx}`"
                                                        class="ml-3 min-w-0 flex-1 text-gray-500"
                                                        >{{
                                                            option.label
                                                        }}</label
                                                    >
                                                </div>
                                            </div>
                                        </DisclosurePanel>
                                    </Disclosure>
                                </form>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </Dialog>
            </TransitionRoot>

            <main class="mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-14"
                >
                    <h1
                        class="text-4xl font-bold tracking-tight text-indigo-700"
                    >
                        Eduguid
                    </h1>

                    <div class="flex items-center">
                        <Menu as="div" class="relative inline-block text-left">
                            <div>
                                <MenuButton
                                    class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
                                >
                                    Sort
                                    <ChevronDownIcon
                                        class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                        aria-hidden="true"
                                    />
                                </MenuButton>
                            </div>

                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95"
                            >
                                <MenuItems
                                    class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                                >
                                    <div class="py-1">
                                        <MenuItem
                                            v-for="option in sortOptions"
                                            :key="option.name"
                                            v-slot="{ active }"
                                        >
                                            <a
                                                :href="option.href"
                                                :class="[
                                                    option.current
                                                        ? 'font-medium text-gray-900'
                                                        : 'text-gray-500',
                                                    active ? 'bg-gray-100' : '',
                                                    'block px-4 py-2 text-sm',
                                                ]"
                                                >{{ option.name }}</a
                                            >
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>

                <section aria-labelledby="products-heading" class="pb-24 pt-6">
                    <h2 id="products-heading" class="sr-only">Products</h2>

                    <div
                        class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4"
                    >
                        <!-- Filters -->
                        <form class="hidden lg:block">
                            <h3 class="sr-only">Categories</h3>
                            <ul
                                role="list"
                                class="space-y-4 border-b border-gray-200 pb-6 text-sm font-medium text-gray-900"
                            >
                                <li
                                    v-for="(
                                        category, categoryIdx
                                    ) in subCategories"
                                    :key="category.value"
                                    class="flex items-center"
                                >
                                    <input
                                        v-model="typeFilter"
                                        :id="`radio-${categoryIdx}`"
                                        name="default-radio"
                                        :value="category.value"
                                        type="radio"
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    />
                                    <label
                                        :for="`${categoryIdx}`"
                                        class="ml-3 text-sm text-gray-600"
                                        >{{ category.label }}</label
                                    >
                                </li>
                            </ul>

                            <Disclosure
                                as="div"
                                v-for="section in filters"
                                :key="section.id"
                                class="border-b border-gray-200 py-6"
                                v-slot="{ open }"
                            >
                                <h3 class="-my-3 flow-root">
                                    <DisclosureButton
                                        class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                    >
                                        <span
                                            class="font-medium text-gray-900"
                                            >{{ section.name }}</span
                                        >
                                        <span class="ml-6 flex items-center">
                                            <PlusIcon
                                                v-if="!open"
                                                class="h-5 w-5"
                                                aria-hidden="true"
                                            />
                                            <MinusIcon
                                                v-else
                                                class="h-5 w-5"
                                                aria-hidden="true"
                                            />
                                        </span>
                                    </DisclosureButton>
                                </h3>
                                <DisclosurePanel class="pt-6">
                                    <div class="space-y-4">
                                        <div
                                            v-for="(
                                                option, optionIdx
                                            ) in section.options"
                                            :key="option.value"
                                            class="flex items-center"
                                        >
                                            <input
                                                :id="`filter-${section.id}-${optionIdx}`"
                                                :name="`${section.id}[]`"
                                                :value="option.value"
                                                type="checkbox"
                                                :checked="option.checked"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                            />
                                            <label
                                                :for="`filter-${section.id}-${optionIdx}`"
                                                class="ml-3 text-sm text-gray-600"
                                                >{{ option.label }}</label
                                            >
                                        </div>
                                    </div>
                                </DisclosurePanel>
                            </Disclosure>
                        </form>

                        <!-- Product grid -->
                        <div class="lg:col-span-3">
                            <div
                                v-if="typeFilter == 'All'"
                                class="grid grid-cols-2 gap-4"
                            >
                                <div
                                    v-for="resource in store.state
                                        .clientResources.all"
                                    :key="resource.id"
                                >
                                    <div
                                        v-if="resource.type == 'Book'"
                                        class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100"
                                    >
                                        <img
                                            class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                                            :src="resource.thumbnailimage"
                                            :alt="resource.title"
                                        />
                                        <div
                                            class="flex flex-col justify-between p-4 leading-normal"
                                        >
                                            <div
                                                class="flex flex-row justify-end"
                                            >
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded"
                                                    >Book</span
                                                >
                                            </div>

                                            <h5
                                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900"
                                            >
                                                {{ resource.title }}
                                            </h5>
                                            <p
                                                class="mb-3 font-normal text-gray-700"
                                            >
                                                {{ resource.description }}
                                            </p>
                                            <button
                                                type="button"
                                                @click="openModal(resource)"
                                                class="w-40 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                                            >
                                                Learn more
                                                <svg
                                                    class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                                                    aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 14 10"
                                                >
                                                    <path
                                                        stroke="currentColor"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M1 5h12m0 0L9 1m4 4L9 9"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div
                                        v-if="resource.type == 'Article'"
                                        class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100"
                                    >
                                        <img
                                            class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                                            :src="resource.thumbnailimage"
                                            :alt="resource.title"
                                        />
                                        <div
                                            class="flex flex-col justify-between p-4 leading-normal"
                                        >
                                            <div
                                                class="flex flex-row justify-end"
                                            >
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded"
                                                    >Article</span
                                                >
                                            </div>
                                            <h5
                                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900"
                                            >
                                                {{ resource.title }}
                                            </h5>
                                            <p
                                                class="mb-3 font-normal text-gray-700"
                                            >
                                                {{ resource.description }}
                                            </p>
                                            <button
                                                type="button"
                                                @click="openModal(resource)"
                                                class="w-40 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                                            >
                                                Learn more
                                                <svg
                                                    class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                                                    aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 14 10"
                                                >
                                                    <path
                                                        stroke="currentColor"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M1 5h12m0 0L9 1m4 4L9 9"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div
                                        v-if="resource.type == 'Video'"
                                        class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100"
                                    >
                                        <vue-plyr
                                            class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                                        >
                                            <div class="plyr__video-embed">
                                                <iframe
                                                    :src="resource.url"
                                                    allowfullscreen
                                                    allowtransparency
                                                    allow="autoplay"
                                                ></iframe>
                                            </div>
                                        </vue-plyr>
                                        <div
                                            class="flex flex-col justify-between p-4 leading-normal"
                                        >
                                            <div
                                                class="flex flex-row justify-end"
                                            >
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded"
                                                    >Video</span
                                                >
                                            </div>
                                            <h5
                                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900"
                                            >
                                                {{ resource.title }}
                                            </h5>
                                            <p
                                                class="mb-3 font-normal text-gray-700"
                                            >
                                                {{ resource.description }}
                                            </p>
                                            <button
                                                type="button"
                                                @click="openModal(resource)"
                                                class="w-40 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                                            >
                                                Learn more
                                                <svg
                                                    class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                                                    aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 14 10"
                                                >
                                                    <path
                                                        stroke="currentColor"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M1 5h12m0 0L9 1m4 4L9 9"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                v-if="typeFilter == 'Books'"
                                class="grid grid-cols-2 gap-4"
                            >
                                <div
                                    v-for="resource in store.state
                                        .clientResources.books"
                                    :key="resource.id"
                                >
                                    <div
                                        class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100"
                                    >
                                        <img
                                            class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                                            :src="resource.thumbnailimage"
                                            :alt="resource.title"
                                        />
                                        <div
                                            class="flex flex-col justify-between p-4 leading-normal"
                                        >
                                            <div
                                                class="flex flex-row justify-end"
                                            >
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded"
                                                    >Book</span
                                                >
                                            </div>

                                            <h5
                                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900"
                                            >
                                                {{ resource.title }}
                                            </h5>
                                            <p
                                                class="mb-3 font-normal text-gray-700"
                                            >
                                                {{ resource.description }}
                                            </p>
                                            <button
                                                type="button"
                                                @click="openModal(resource)"
                                                class="w-40 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                                            >
                                                Learn more
                                                <svg
                                                    class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                                                    aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 14 10"
                                                >
                                                    <path
                                                        stroke="currentColor"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M1 5h12m0 0L9 1m4 4L9 9"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                v-if="typeFilter == 'Article'"
                                class="grid grid-cols-2 gap-4"
                            >
                                <div
                                    v-for="resource in store.state
                                        .clientResources.articles"
                                    :key="resource.id"
                                >
                                    <div
                                        class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100"
                                    >
                                        <img
                                            class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                                            :src="resource.thumbnailimage"
                                            :alt="resource.title"
                                        />
                                        <div
                                            class="flex flex-col justify-between p-4 leading-normal"
                                        >
                                            <div
                                                class="flex flex-row justify-end"
                                            >
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded"
                                                    >Article</span
                                                >
                                            </div>

                                            <h5
                                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900"
                                            >
                                                {{ resource.title }}
                                            </h5>
                                            <p
                                                class="mb-3 font-normal text-gray-700"
                                            >
                                                {{ resource.description }}
                                            </p>
                                            <button
                                                type="button"
                                                @click="openModal(resource)"
                                                class="w-40 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                                            >
                                                Learn more
                                                <svg
                                                    class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                                                    aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 14 10"
                                                >
                                                    <path
                                                        stroke="currentColor"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M1 5h12m0 0L9 1m4 4L9 9"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                v-if="typeFilter == 'Video'"
                                class="grid grid-cols-2 gap-4"
                            >
                                <div
                                    v-for="resource in store.state
                                        .clientResources.videos"
                                    :key="resource.id"
                                >
                                    <div
                                        class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100"
                                    >
                                        <img
                                            class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                                            :src="resource.thumbnailimage"
                                            :alt="resource.title"
                                        />
                                        <div
                                            class="flex flex-col justify-between p-4 leading-normal"
                                        >
                                            <div
                                                class="flex flex-row justify-end"
                                            >
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded"
                                                    >Video</span
                                                >
                                            </div>

                                            <h5
                                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900"
                                            >
                                                {{ resource.title }}
                                            </h5>
                                            <p
                                                class="mb-3 font-normal text-gray-700"
                                            >
                                                {{ resource.description }}
                                            </p>
                                            <button
                                                type="button"
                                                @click="openModal(resource)"
                                                class="w-40 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                                            >
                                                Learn more
                                                <svg
                                                    class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                                                    aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 14 10"
                                                >
                                                    <path
                                                        stroke="currentColor"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M1 5h12m0 0L9 1m4 4L9 9"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <!-- modal -->
            <TransitionRoot appear :show="isOpen" as="template">
                <Dialog as="div" @close="closeModal" class="relative z-10">
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0"
                        enter-to="opacity-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100"
                        leave-to="opacity-0"
                    >
                        <div class="fixed inset-0 bg-black/25" />
                    </TransitionChild>

                    <div class="fixed inset-0">
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
                                    class="w-full max-w-[65rem] max-h-[41rem] transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                                >
                                    <div
                                        class="relative flex w-full items-center overflow-hidden bg-white"
                                    >
                                        <button
                                            type="button"
                                            @click="closeModal"
                                            class="absolute right-4 top-0 text-gray-400 hover:text-gray-500"
                                        >
                                            <span class="sr-only">Close</span>
                                            <XMarkIcon
                                                class="h-6 w-6"
                                                aria-hidden="true"
                                            />
                                        </button>

                                        <div
                                            v-if="resourceInView"
                                            class="w-full h-screen overflow-y-auto pb-20"
                                        >
                                            <div
                                                class="grid mt-6 w-full grid-cols-1 items-start gap-x-6 gap-y-8 sm:grid-cols-12 lg:gap-x-8"
                                            >
                                                <div
                                                    class="h-[25rem] w-full overflow-hidden rounded-lg bg-gray-100 sm:col-span-8 lg:col-span-7"
                                                >
                                                    <vue-plyr
                                                        v-if="
                                                            resourceInView.type ==
                                                            'Video'
                                                        "
                                                    >
                                                        <div
                                                            class="plyr__video-embed"
                                                        >
                                                            <iframe
                                                                :src="
                                                                    resourceInView.url
                                                                "
                                                                allowfullscreen
                                                                allowtransparency
                                                                allow="autoplay"
                                                            ></iframe>
                                                        </div>
                                                    </vue-plyr>
                                                    <img
                                                        v-else
                                                        :src="
                                                            resourceInView.thumbnailimage
                                                        "
                                                        :alt="
                                                            resourceInView.title
                                                        "
                                                        class="aspect-h-3 aspect-w-2 object-cover object-center"
                                                    />
                                                </div>
                                                <div
                                                    class="sm:col-span-4 lg:col-span-5"
                                                >
                                                    <h2
                                                        class="text-2xl font-bold text-gray-900 sm:pr-12"
                                                    >
                                                        {{
                                                            resourceInView.title
                                                        }}
                                                    </h2>

                                                    <section
                                                        aria-labelledby="information-heading"
                                                        class="mt-2"
                                                    >
                                                        <h3
                                                            class="text-gray-700"
                                                        >
                                                            {{
                                                                resourceInView.description
                                                            }}
                                                        </h3>
                                                    </section>

                                                    <section
                                                        aria-labelledby="options-heading"
                                                        class="mt-10"
                                                    >
                                                        <a
                                                            v-if="
                                                                resourceInView.type ===
                                                                'Book'
                                                            "
                                                            :href="
                                                                resourceInView.url
                                                            "
                                                            target="_blank"
                                                            class="mt-6 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                                        >
                                                            Buy book
                                                        </a>
                                                        <a
                                                            v-if="
                                                                resourceInView.type ===
                                                                'Article'
                                                            "
                                                            :href="
                                                                resourceInView.url
                                                            "
                                                            target="_blank"
                                                            class="mt-6 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                                        >
                                                            Read Article
                                                        </a>
                                                        <a
                                                            v-if="
                                                                resourceInView.type ===
                                                                'Video'
                                                            "
                                                            :href="
                                                                resourceInView.url
                                                            "
                                                            target="_blank"
                                                            class="mt-6 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                                        >
                                                            Watch Video
                                                        </a>
                                                    </section>
                                                </div>
                                            </div>
                                            <div class="px-4 mt-10">
                                                <form
                                                    @submit.prevent="
                                                        submitReview
                                                    "
                                                    class="mb-16"
                                                >
                                                    <label
                                                        for="message"
                                                        class="block mb-2 text-sm font-medium text-gray-900"
                                                        >Leave a review</label
                                                    >
                                                    <textarea
                                                        v-model="
                                                            reviewData.text
                                                        "
                                                        id="message"
                                                        rows="4"
                                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                                        placeholder="Write your review here..."
                                                    ></textarea>
                                                    <button
                                                        type="button"
                                                        @click="submitReview"
                                                        class="my-6 px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                    >
                                                        Submit
                                                    </button>
                                                </form>
                                                <h3
                                                    class="font-bold text-2xl text-black"
                                                >
                                                    Reviews
                                                </h3>
                                                <figure
                                                    v-for="review in store.state
                                                        .reviews.data"
                                                    :key="review.id"
                                                    class="mt-10 max-w-screen-md"
                                                >
                                                    <blockquote>
                                                        <p
                                                            class="text-2xl font-semibold text-gray-900"
                                                        >
                                                            {{ review.text }}
                                                        </p>
                                                    </blockquote>
                                                    <figcaption
                                                        class="flex items-center mt-6 space-x-3 rtl:space-x-reverse"
                                                    >
                                                        <img
                                                            class="w-6 h-6 rounded-full"
                                                            src=""
                                                            alt="profile picture"
                                                        />
                                                        <div
                                                            class="flex items-center divide-x-2 rtl:divide-x-reverse divide-gray-300"
                                                        >
                                                            <cite
                                                                class="pe-3 font-medium text-gray-900"
                                                                >{{
                                                                    review.firstname
                                                                }}</cite
                                                            >
                                                            <cite
                                                                class="ps-3 text-sm text-gray-500"
                                                                >CTO at
                                                                Flowbite</cite
                                                            >
                                                        </div>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </Dialog>
            </TransitionRoot>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, computed, onMounted, isProxy, toRaw, nextTick } from "vue";
import { useStore } from "vuex";
import { useRoute, useRouter } from "vue-router";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
} from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import {
    ChevronDownIcon,
    FunnelIcon,
    MinusIcon,
    PlusIcon,
    Squares2X2Icon,
} from "@heroicons/vue/20/solid";
import { TransitionRoot, TransitionChild } from "@headlessui/vue";

import store from "../store";

onMounted(async () => {
    //loading.value = true;
    await store.dispatch("getUser");
    await store.dispatch("getClientResources");
});

const typeFilter = ref("");
const resourceInView = ref(null);

const isOpen = ref(false);

const reviewData = {
    rating: null,
    resource_id: null,
    text: "",
};

onMounted(async () => {
    //loading.value = true;
    typeFilter.value = "All";
});

const submitReview = async (ev) => {
    ev.preventDefault();
    reviewData.resource_id = resourceInView.value.id;
    console.log(reviewData);
    await store
        .dispatch("submitReview", reviewData)
        .then((data) => {
            console.log(data);
            store.dispatch("getReviews", resourceInView.value.id);
        })
        .catch((error) => {
            console.log(error);
        });
};

function closeModal() {
    isOpen.value = false;
}
function openModal(resource) {
    resourceInView.value = resource;
    store.dispatch("getReviews", resourceInView.value.id);
    isOpen.value = true;
}

const sortOptions = [
    { name: "Most Popular", href: "#", current: true },
    { name: "Best Rating", href: "#", current: false },
    { name: "Newest", href: "#", current: false },
    { name: "Price: Low to High", href: "#", current: false },
    { name: "Price: High to Low", href: "#", current: false },
];
const subCategories = [
    { value: "All", label: "All", checked: true },
    { value: "Books", label: "Books", checked: false },
    { value: "Article", label: "Article", checked: false },
    { value: "Video", label: "Video", checked: false },
];
const filters = [
    {
        id: "year",
        name: "Year",
        options: [
            { value: 1, label: "1", checked: false },
            { value: 2, label: "2", checked: false },
            { value: 3, label: "3", checked: false },
            { value: 4, label: "4", checked: false },
        ],
    },
    {
        id: "category",
        name: "Category",
        options: [
            { value: "new-arrivals", label: "New Arrivals", checked: false },
            { value: "sale", label: "Sale", checked: false },
            { value: "travel", label: "Travel", checked: true },
            { value: "organization", label: "Organization", checked: false },
            { value: "accessories", label: "Accessories", checked: false },
        ],
    },
];

watch(
    () => typeFilter.value,
    (newVal, oldVal) => {
        console.log(typeFilter.value);
    }
);
const mobileFiltersOpen = ref(false);
</script>
