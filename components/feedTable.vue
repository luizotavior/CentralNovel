<template>
    <section id="feed-table">
        <b-table
            :data="data"
            :loading="loading"
            paginated
            backend-pagination
            :total="total"
            :per-page="perPage"
            @page-change="onPageChange"
            :mobile-cards="false">
            <template slot-scope="props" slot="header">
                <div class="table-title">
                    {{ props.column.label }}
                </div>
            </template>
            <template slot-scope="props">
                <b-table-column class="blabla" field="original_title" label="Gênero" :visible="($mq == 'mobile' ? false : true)">
                    <a href="#" class="__genero">{{ props.row.original_title }}</a>
                </b-table-column>
                <b-table-column field="original_title" label="Title">
                    <a href="#" class="__titulo">{{ props.row.original_title }}</a>
                </b-table-column>
                <b-table-column field="original_title" label="Release">
                    <a href="#" class="__release">{{ props.row.original_title }}</a>
                </b-table-column>
                <b-table-column field="original_title" label="Autor" :visible="($mq == 'tablet' || $mq == 'mobile' ? false : true)">
                    <a href="#" class="__autor">{{ props.row.original_title }}</a>
                </b-table-column>
                <b-table-column field="original_title" label="Tradutor" :visible="($mq == 'tablet' || $mq == 'mobile' ? false : true)">
                    <a href="#" class="__tradutor">{{ props.row.original_title }}</a>
                </b-table-column>
                <b-table-column field="release_date" label="Time">
                    <span class="__time">{{ props.row.release_date ? new Date(props.row.release_date).toLocaleDateString() : '' }}</span>
                </b-table-column>

            </template>
        </b-table>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                data: [],
                total: 0,
                loading: false,
                page: 1,
                perPage: 20
            }
        },
        methods: {
            /*
             * Load async data
             */
            loadAsyncData() {
                const params = [
                    'api_key=bb6f51bef07465653c3e553d6ab161a8',
                    'language=en-US',
                    'include_adult=false',
                    'include_video=false',
                    `sort_by=${this.sortField}.${this.sortOrder}`,
                    `page=${this.page}`
                ].join('&')

                this.loading = true
                this.$axios.get(`https://api.themoviedb.org/3/discover/movie?${params}`)
                    .then(({ data }) => {
                        // api.themoviedb.org manage max 1000 pages
                        this.data = []
                        let currentTotal = data.total_results
                        if (data.total_results / this.perPage > 1000) {
                            currentTotal = this.perPage * 1000
                        }
                        this.total = currentTotal
                        data.results.forEach((item) => {
                            item.release_date = item.release_date.replace(/-/g, '/')
                            this.data.push(item)
                        })
                        this.loading = false
                    })
                    .catch((error) => {
                        this.data = []
                        this.total = 0
                        this.loading = false
                        throw error
                    })
            },
            /*
             * Handle page-change event
             */
            onPageChange(page) {
                this.page = page
                this.loadAsyncData()
            },
        },
        mounted() {
            this.loadAsyncData()
        }
    }
</script>

<style lang="scss">
    section#feed-table{
        padding: 12px;
        padding-top: 0px;
        .table{
            background-color: transparent;
            line-height: normal;
            width: 100%;
            overflow-x: auto;
            .table-title{
                color: #83848f;
                font-weight: 400;
                font-size: 14px;
            }
            th,td{
                padding-left: 0px;
                border-width: 0 0 1px;
                border-color: #e3e4ea;
            }
            tbody{
                td{
                    font-weight: 300;
                    color: #83848f;
                    a{
                        color: #000;
                    }
                    a,span{
                        display: block;
                        overflow: hidden;
                        white-space: nowrap;
                        text-overflow: ellipsis;
                    }
                    &:hover{
                        text-decoration: underline;
                    }
                    .__genero{
                        max-width: 7rem;
                        color: #83848f;
                    }
                    .__titulo{
                        max-width: 17rem;
                        @media (max-width: 768px) {
                            max-width: 7rem;
                        }
                    }
                    .__release{
                        max-width: 13rem;
                        @media (max-width: 768px) {
                            max-width: 7rem;
                        }
                    }
                    .__autor{
                        max-width: 7rem;
                    }
                    .__tradutor{
                        max-width: 7rem;
                    }
                    .__time{
                        max-width: 7rem;
                        color: #83848f;
                    }
                }
            }
        }
    }
</style>
