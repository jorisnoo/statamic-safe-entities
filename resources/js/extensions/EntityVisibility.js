let stylesInjected = false;

function injectStyles() {
    if (stylesInjected) return;
    stylesInjected = true;

    const style = document.createElement('style');
    style.textContent = `
        .entity-marker {
            background-color: #e5e7eb;
            color: #374151;
            border-radius: 2px;
            padding: 0 1px;
            font-size: 0.7em;
            font-family: ui-monospace, monospace;
        }
        .entity-hidden {
            font-size: 0;
            line-height: 0;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
}

export function createEntityVisibilityExtension(tiptap) {
    const { Extension } = tiptap.core;
    const { Plugin, PluginKey } = tiptap.pm.state;
    const { Decoration, DecorationSet } = tiptap.pm.view;

    const pluginKey = new PluginKey('entityVisibility');

    injectStyles();

    return Extension.create({
        name: 'entityVisibility',

        addStorage() {
            return { visible: true };
        },

        addCommands() {
            return {
                toggleEntityVisibility:
                    () =>
                    ({ tr, dispatch }) => {
                        if (dispatch) {
                            tr.setMeta(pluginKey, 'toggle');
                        }
                        return true;
                    },
                showEntities:
                    () =>
                    ({ tr, dispatch }) => {
                        if (dispatch) {
                            tr.setMeta(pluginKey, 'show');
                        }
                        return true;
                    },
            };
        },

        addProseMirrorPlugins() {
            const entities = Object.keys(Statamic.$config.get('safeEntities') || {});
            const storage = this.storage;

            function buildDecorations(doc, entities, visible) {
                const cssClass = visible ? 'entity-marker' : 'entity-hidden';
                const decorations = [];

                doc.descendants((node, pos) => {
                    if (!node.isText) return;

                    const text = node.text;

                    for (const entity of entities) {
                        let index = 0;
                        while ((index = text.indexOf(entity, index)) !== -1) {
                            decorations.push(
                                Decoration.inline(pos + index, pos + index + entity.length, {
                                    class: cssClass,
                                    'data-entity': entity,
                                }),
                            );
                            index += entity.length;
                        }
                    }
                });

                return DecorationSet.create(doc, decorations);
            }

            return [
                new Plugin({
                    key: pluginKey,

                    state: {
                        init(_, state) {
                            return { visible: true, decorations: buildDecorations(state.doc, entities, true) };
                        },

                        apply(tr, value, oldState, newState) {
                            const meta = tr.getMeta(pluginKey);
                            let visible = value.visible;

                            if (meta === 'toggle') {
                                visible = !visible;
                            } else if (meta === 'show') {
                                visible = true;
                            }

                            storage.visible = visible;

                            if (!tr.docChanged && !meta) {
                                return {
                                    visible,
                                    decorations: value.decorations.map(tr.mapping, tr.doc),
                                };
                            }

                            return {
                                visible,
                                decorations: buildDecorations(newState.doc, entities, visible),
                            };
                        },
                    },

                    props: {
                        decorations(state) {
                            return this.getState(state).decorations;
                        },
                    },
                }),
            ];
        },
    });
}
