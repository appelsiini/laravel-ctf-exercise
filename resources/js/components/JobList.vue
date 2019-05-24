<template>
    <div class="container jobs">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <vuetable
                        ref="vuetable"
                        api-url="http://laracon-madrid.com:1234/api/jobs"
                        :fields="fields"
                        :query-params="params"
                        data-path=""
                        pagination-path=""
                        pagination-data=""
                        :show-pagination="false"
                    ></vuetable>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Vuetable from 'vuetable-2/src/components/Vuetable'

    export default {
        components: {
            Vuetable
        },
        data() {
            return {
                fields: [
                    'id',
                    'title',
                    {
                        name: 'created_at',
                        title: 'Created At'
                    }
                ],
                params: () => {
                    return {
                        sort: 'id',
                    }
                }
            }
        },
    }
</script>
<style lang="scss">
    .jobs {
        table {
            @apply w-full;
            thead {
                tr {
                    text-align: left;
                }
            }

            td, th {
                @apply p-2;
            }

            tr:nth-child(even) {
                @apply bg-grey-lightest;
            }
        }
    }
</style>
