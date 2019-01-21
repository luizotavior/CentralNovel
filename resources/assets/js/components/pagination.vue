<script>
    import { range } from 'lodash'
    export default {
        props: ['source'],


        data () {
            return {
                pages: []
            }
        },
        methods: {

            navigate(ev, page){
                ev.preventDefault()
                this.$emit('navigate', page)
            },
            nextNavigate(ev){
                if(this.source.current_page+1 == this.source.last_page+1){
                    return false;
                }
                this.navigate(ev, this.source.current_page+1)
            },
            prevNavigate(ev){
                if(this.source.current_page-1 == 0){
                    return false;
                }
                this.navigate(ev, this.source.current_page-1)
            }
        },
        computed:{
        },
        watch: {
            source () {
                this.pages = range(1,this.source.last_page+1)
            }
        },
        mounted() {
            
        }
    }
</script>

<template>
    <nav class="pagination" aria-label="Page navigation example">
        <ul class="pagination">
            <li :class="{disable: source.current_page == 1}"><a class="page-link" href="javascript:void(0);" @click="prevNavigate($event, source.current_page-1)"><i class="fa fa-angle-left"></i></a></li>
            
            <li class="page-item" v-if="source.current_page > 1">
                <a class="page-link" href="javascript:void(0);" @click="navigate($event, source.current_page-1)">
                    {{source.current_page-1}}
                </a>
            </li>
            <li class="page-item"  :class="{active: source.current_page == source.current_page}">
                <a class="page-link" href="javascript:void(0);" @click="navigate($event, source.current_page)">
                    {{source.current_page}}
                </a>
            </li>
            <li class="page-item" v-if="source.current_page < source.last_page">
                <a class="page-link" href="javascript:void(0);" @click="navigate($event,source.current_page+1)">
                    {{source.current_page+1}}
                </a>
            </li>
            <li :class="{disable: source.current_page == source.last_page}"><a class="page-link" href="javascript:void(0);"  @click="nextNavigate($event, source.current_page+1)"><i class="fa fa-angle-right"></i></a></li>
        </ul>
    </nav>
</template>

<style lang="stylus" scoped>
    //Import Helpers
    @import '../../stylus/base/colors.styl'
    @import '../../stylus/helpers/all.styl'
    @import '../../stylus/helpers/helpers.styl'
    @import '../../stylus/layout/grid.styl'
    //Component Stylus
    nav.pagination
        display flex
        flex-direction row
        @extends $justify-center
        margin-bottom 10px
        ul
            display flex
            flex-direction row
            margin 0px
            padding 0px
            li
                list-style: none
                padding 3px 4px
                color white
                background-color white
                SourceSansPro(Bold)
                a
                    padding 0px
                    color gray-dark
                &.active
                    background-color cor-02
                    border-radius 5px
                    a
                        color white
                &.disable
                background-color white
                    a
                        cursor: default;

</style>