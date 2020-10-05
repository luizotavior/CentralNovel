// plugins/tui-editor.client.js
import Vue from "vue";
import { Editor, Viewer } from "@toast-ui/vue-editor";

import "codemirror/lib/codemirror.css";
import "@toast-ui/editor/dist/toastui-editor.css";

Vue.component("TuiEditor", Editor); // <TuiEditor />
Vue.component("TuiViewer", Viewer); // <TuiViewer />
