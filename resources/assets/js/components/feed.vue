<script>
import CentralPagination from "./pagination.vue"
import Paginate from 'vuejs-paginate'
export default {
	components: {
	CentralPagination,
	Paginate
	},

	data() {
		return {
			pagination: {},
			feed: {},
		};
	},
	methods: {
		navigate(page) {
			this.$http
			.get("/api/feed?page="+page
			)
			.then(req => {
				this.feed = req.data.data;
				this.pagination = req.data;
			});
		},
		playSound (sound) {
			if(sound) {
				var audio = new Audio(sound);
				audio.play();
			}
		},
		isEmptyObject(obj) {
			var name;
			for (name in obj) {
				return false;
			}
			return true;
		},
		buscarDados(){
			//Função que atualiza o objeto 'Feed'
			this.$http
			.get("/api/feed?page="+this.pagination.current_page
			)
			.then(req => {
				//Verifica se ouve alteração no total de items encontrados.
				if(!this.isEmptyObject(this.pagination) && this.pagination.total != req.data.total){
					this.playSound('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3')
				}
				//Salva
				this.feed = req.data.data;
				this.pagination = req.data;
			});
			setTimeout(() => this.buscarDados(),60000)
		}
	},
	computed: {
		orderedFeed: function() {
			return this.feed;
		}
	},
	mounted() {
		this.buscarDados(0)
	}
};
</script>

<template>
	<div>
		<table id="feeding" class="display feed-table" cellspacing="0" width="100%">
			<thead>
				<tr class="titulo">
					<th>Novel</th>
					<th>Release</th>
					<th>Grupo</th>
					<th>Data</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="f in orderedFeed">
					<td><a :href="'/novel/'+f.novel.url" target="_blank"> {{f.novel.titulo}}</a></td>
					<td><a :href="'/extcn/'+f.id" target="_blank">{{f.release}}</a></td>
					<td><a :href="'/grupo/'+f.grupo.url" target="_blank"> {{f.grupo.nome}}</a></td>
					<td>{{f.published}}</td>
				</tr>
			</tbody>
		</table>
    	<nav class="pagination" aria-label="Page navigation example">
		<central-pagination :source="pagination" @navigate="navigate"></central-pagination>
		</nav>
	</div>
</template>
<style lang="stylus">
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
        .pagination {
			list-style: none;

			.page-item {
				display: inline-block;
				border: @border;
				border-right: 0;

				&:last-child {
					border-right: @border;
				}

				.page-link {
					padding: 8px 12px;
					cursor: pointer;
					display: block;
					color: @color-blue-light;
				}

				&.active .page-link {
					color: white;
					background-color: @color-blue;
					border-color: @color-blue-light;
				}

				&.arrow_disable div {
					display: block;
					padding: 8px 12px;
					color: @color-gray;
				}
			}
		}
</style>