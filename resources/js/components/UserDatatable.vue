<template>
    <data-table
        url="/users"
        :per-page="perPage"
        :columns="columns"
        :add-filters-to-url="true">
    </data-table>
</template>

<script>
    export default {
        name: 'app',
        data() {
            return {
                perPage: ['10', '25', '50'],
                columns: [
                    {
                        label: 'ID',
                        name: 'id',
                        filterable: true,
                        meta: {
                            hello: "World"
                        }
                    },
                    {
                        label: 'Name',
                        name: 'name',
                        filterable: true,
                    },
                    {
                        label: 'Email',
                        name: 'email',
                        filterable: true,
                    },
                ]
            }
        },
    }
</script>
