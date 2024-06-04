<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
const props = defineProps({
    // permissions: {
    //     type: Object,
    //     required: true,
    // },
    permissyons: {
        type: Object,
        required: true,
    },
    user_permissions: {
        type: Object,
        required: true,
    }
})

const userPermissions = props.user_permissions.permissions;

const form = useForm({
    rolePermissions: props.permissyons
})

const ontohod = (idx) => {
    const trigger = document.getElementById('trigger' + idx);
    const childs = document.getElementsByName('child' + idx);
    if (trigger.checked) {
        childs.forEach(element => {
            element.checked = true
        })
    } else {
        childs.forEach(element => {
            element.checked = false
        })
    }
}

</script>
<template>

    <Head title="Permission" />

    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Permission</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <ul v-for="( permissyon, index ) in permissyons" :key="index">
                            <li>
                                <h1><input type="checkbox" :id="'trigger' + index" @change="ontohod(index)" />{{
                                    index }}
                                </h1>
                                <ul>
                                    <li v-for="permissyong in permissyon" :key="permissyong.id">
                                        <input type="checkbox" :name="'child' + index"
                                            v-model="form.rolePermissions.index" :value="permissyong.name"
                                            v-bind:checked="userPermissions.includes(permissyong.name)" />
                                        {{ permissyong.name }}
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
