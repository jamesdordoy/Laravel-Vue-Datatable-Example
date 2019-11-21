<template>
    <data-table
        url="/api/query-builder"
        :columns="columns">
    </data-table>
</template>

<script>
    export default {
        name: 'app',
        data() {
            return {
                columns: [
                    {
                        label: 'ID',
                        name: 'id',
                        filterable: true,
                    },
                    {
                        label: 'Name',
                        name: 'user_name',
                        columnName: 'users.name',
                        filterable: true,
                    },
                    {
                        label: 'Email',
                        name: 'email',
                        filterable: true,
                    },
                    {
                        label: 'Cost',
                        name: 'cost',
                        filterable: true,
                    },
                    {
                        label: 'Role',
                        name: 'role_name',
                        columnName: 'roles.name',
                        filterable: true,
                    },
                ]
            }
        },
    }
</script>
