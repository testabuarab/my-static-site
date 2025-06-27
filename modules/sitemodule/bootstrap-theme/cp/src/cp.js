import Draggable from 'vuedraggable';
import './cp.scss';

document.addEventListener("register-form-fields-components", function(event) {
    event.detail['bootstrap-zones'] = {
        template: `
            <div class="field bootstrap-zones" :id="'field-' + name">
                <div class="heading" v-if="definition.label">
                    <label :class="{required: definition.required ?? false}">{{ definition.label }}</label>
                    <a href="#" @click.prevent="showHidden = !showHidden">{{ showHidden ? 'Hide hidden' : 'Show hidden'}}</a>
                </div>
                <div class="instructions" v-if="definition.instructions" v-html="definition.instructions">
                </div>
                <div class="zones-wrapper">
                    <div v-for="label, zone in definition.zones" class="zone" :style="sizeStyle">
                        <label>{{ label }}</label>
                        <draggable
                            item-key="uid"
                            :list="items[zone]"
                            group="displays"
                            handle=".move"
                            class="zone-displays"
                        >
                            <template #item="{element}">
                                <div :class="{item: true, opaque: element.hidden}" v-show="showHidden || !element.hidden">
                                    <span class="move icon"></span> {{ element.name }}
                                </div>
                            </template>
                        </draggable>
                    </div>
                </div>
                <p v-if="definition.tip" class="notice with-icon" v-html="definition.tip">
                </p>
                <p v-if="definition.warning" class="warning with-icon" v-html="definition.warning">
                </p>
                <ul class="errors" v-if="errors">
                    <li class="error" v-for="error, index in errors" v-bind:key="index">
                        {{ error }}
                    </li>
                </ul>
            </div>`,
        props: {
            value: Object,
            definition: Object,
            errors: Array,
            name: String
        },
        computed: {
            sizeStyle: function () {
                return 'width: calc(' + (100 / Object.keys(this.definition.zones).length) + '% - 5px)';
            }
        },
        data: function () {
            return {
                items: {},
                showHidden: false
            };
        },
        watch: {
            items: {
                handler: function () {
                    let value = {};
                    for (let zone in this.items) {
                        value[zone] = [];
                        for (let display of this.items[zone]) {
                            value[zone].push(display.uid);
                        }
                    }
                    this.$emit('change', value);
                },
                deep: true
            }
        },
        created() {
            if (this.definition.items) {
                this.refreshZones(this.definition.items);
            }
        },
        methods: {
            fetchFields: function (viewModeUid) {
                let url = 'themes/ajax/view-modes/displays/' + viewModeUid;
                axios.post(Craft.getCpUrl(url))
                .then((response) => {
                    this.refreshZones(response.data.displays.map(display => {
                        return {
                            uid: display.uid,
                            name: display.item.name,
                            hidden: display.item.hidden || display.item.visuallyHidden,
                        };
                    }));
                })
                .catch((err) => {
                    this.handleError(err);
                });
            },
            refreshZones: function (displays) {
                this.items = {};
                for (let handle in this.definition.zones) {
                    this.items[handle] = [];
                }
                for (let display of displays) {
                    let zone = this.findZone(display);
                    if (!zone) {
                        this.items[this.definition.defaultZone].push(display);
                    } else {
                        this.items[zone].push(display);
                    }
                }
            },
            findZone: function (display) {
                for (let handle in this.definition.zones) {
                    if (this.value && this.value[handle] && this.value[handle].includes(display.uid)) {
                        return handle;
                    }
                }
                return false;
            }
        },
        mounted() {
            if (this.definition.itemsFrom) {
                let _this = this;
                let elems = this.definition.itemsFrom.split(':');
                $(elems[0]).find(elems[1]).change(function () {
                    _this.fetchFields($(this).val());
                });
                let val = $(elems[0]).find(elems[1]).val();
                if (val) {
                    this.fetchFields(val);
                }
            }
        },
        components: {
            'draggable': Draggable
        },
        emits: ['change']
    };
});