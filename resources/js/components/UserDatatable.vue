<template>
    <div>
        <div>
            <h1>Eloquent</h1>
            <button @click="reloadTableEloquent" class='btn btn-primary mb-2'>
                Reload
            </button>

            <data-table
                ref="eloquent"
                url="/api/eloquent"
                :columns="eloquentColumns">
            </data-table>
        </div>
        <div>
            <h1>Query Builder</h1>
            <button @click="reloadQueryTable" class='btn btn-primary mb-2'>
                Reload
            </button>

            <!-- <data-table
                ref="queryBuild"
                url="/api/query-builder"
                :columns="columns">
            </data-table> -->
        </div>
        <div>
            <h1>Local Data</h1>
            <!-- <data-table
                ref="userTable"
                :data="data"
                :columns="columns"
                @onTablePropsChanged="reloadLocalTable">
            </data-table> -->
        </div>
    </div>
</template>

<script>


    export default {
        name: 'app',
        methods: {
            reloadTableEloquent() {
                this.$refs.eloquent.getData()
            },
            reloadQueryTable(options) {
                this.getData(this.url, options);
            },
            reloadLocalTable(options) {
                this.getData(this.url, options);
            },
            getData(url = this.url, options = this.tableProps) {
                axios.get(url, {
                    params: options
                })
                .then(response => {
                   this.data = response.data;                   
                })
                .catch(error => {

                });
            }
        },
        created() {
            this.getData();
        },
        data() {
            return {
                data: {},
                url: "/api/query-builder",
                tableProps: {
                    search: '',
                    length: 10,
                    column: 'id',
                    dir: 'asc',
                },
                eloquentColumns: [
                    {
                        label: 'ID',
                        name: 'id',
                        width: 10,
                        orderable: true,
                    },
                    {
                        label: 'Name',
                        name: 'name',
                        width: 20,
                        columnName: 'users.name',
                        orderable: true,
                    },
                    {
                        label: 'Email',
                        name: 'email',
                        width: 20,
                        orderable: true,
                    },
                    {
                        label: 'Cost',
                        name: 'cost',
                        width: 20,
                        orderable: true,
                    },
                    {
                        label: 'Role',
                        name: 'role.name',
                        columnName: 'roles.name',
                        width: 30,
                        orderable: true,
                    },
                ],
                columns: [
                    {
                        label: 'ID',
                        name: 'id',
                        width: 10,
                        orderable: true,
                    },
                    {
                        label: 'Name',
                        name: 'user_name',
                        width: 20,
                        columnName: 'users.name',
                        orderable: true,
                    },
                    {
                        label: 'Email',
                        name: 'email',
                        width: 20,
                        orderable: true,
                    },
                    {
                        label: 'Cost',
                        name: 'cost',
                        width: 20,
                        orderable: true,
                    },
                    {
                        label: 'Role',
                        name: 'role_name',
                        columnName: 'roles.name',
                        width: 30,
                        orderable: true,
                    },
                ]
            }
        },
    }
</script>
