<script setup>

import { ref } from "vue";
const changselect = ref(true);

const parentOptions = ref([
    { name: "Parent 1", children: ["Child 1A", "Child 1B", "Child 1C"] },
    { name: "Parent 2", children: ["Child 2A", "Child 2B"] },
    { name: "Parent 3", children: ["Child 3A", "Child 3B", "Child 3C"] },
]);

const selectedParent = ref(null);
const selectedChild = ref(null);

function getChildOptions(parentName) {
    const parent = parentOptions.value.find((item) => item.name === parentName);
    return parent ? parent.children : [];
}

function onChildChange() {
    if (selectedChild.value) {
        const parentIndex = parentOptions.value.findIndex(
            (item) => item.name === selectedParent.value
        );

        // Add selected child as new parent
        if (parentIndex !== -1) {
            parentOptions.value.push({
                name: selectedChild.value,
                children: [],
            });
        }

        selectedChild.value = null;
    }
}
</script>
<template>
      <div class=" ">
                    <div @click="changselect = !changselect">
                        <label for="select">
                             <svg
                xmlns="http://www.w3.org/2000/svg"
                width="62"
                height="62"
                viewBox="0 0 62 62"
                fill="none"
            >
                <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M5.16675 18.0833C5.16675 17.3982 5.43892 16.7411 5.92339 16.2566C6.40786 15.7722 7.06494 15.5 7.75008 15.5H49.0834C49.7686 15.5 50.4256 15.7722 50.9101 16.2566C51.3946 16.7411 51.6667 17.3982 51.6667 18.0833C51.6667 18.7685 51.3946 19.4256 50.9101 19.91C50.4256 20.3945 49.7686 20.6667 49.0834 20.6667H7.75008C7.06494 20.6667 6.40786 20.3945 5.92339 19.91C5.43892 19.4256 5.16675 18.7685 5.16675 18.0833ZM5.16675 29.7083C5.16675 29.0232 5.43892 28.3661 5.92339 27.8816C6.40786 27.3972 7.06494 27.125 7.75008 27.125C19.8563 27.125 26.6438 27.125 38.7501 27.125C39.4352 27.125 40.0923 27.3972 40.5768 27.8816C41.0612 28.3661 41.3334 29.0232 41.3334 29.7083C41.3334 30.3935 41.0612 31.0506 40.5768 31.535C40.0923 32.0195 39.4352 32.2917 38.7501 32.2917H7.75008C7.06494 32.2917 6.40786 32.0195 5.92339 31.535C5.43892 31.0506 5.16675 30.3935 5.16675 29.7083ZM5.16675 41.3333C5.16675 40.6482 5.43892 39.9911 5.92339 39.5066C6.40786 39.0222 7.06494 38.75 7.75008 38.75H23.2501C23.9352 38.75 24.5923 39.0222 25.0768 39.5066C25.5612 39.9911 25.8334 40.6482 25.8334 41.3333C25.8334 42.0185 25.5612 42.6756 25.0768 43.16C24.5923 43.6445 23.9352 43.9167 23.2501 43.9167H7.75008C7.06494 43.9167 6.40786 43.6445 5.92339 43.16C5.43892 42.6756 5.16675 42.0185 5.16675 41.3333Z"
                    fill="#8858BB"
                />
                <path
                    d="M49.0824 41.3335L40.1253 50.4589L30.9999 41.5017"
                    stroke="#8858BB"
                    stroke-width="3"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>

                        </label>
                    </div>
                    <div class="absolute left-[-30px] top-[30px]">
                        <select
                            v-if="changselect"
                            v-model="selectedParent"
                            @change="onParentChange"
                            id="select"
                            class="outline-0"
                        >
                            <option
                                v-for="(item, index) in parentOptions"
                                :key="index"
                                :value="item.name"
                            >
                                {{ item.name }}
                            </option>
                        </select>
                    </div>

                </div>
</template>
