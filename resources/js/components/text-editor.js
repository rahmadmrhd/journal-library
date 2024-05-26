import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import Paragraph from '@editorjs/paragraph';
import Underline from '@editorjs/underline';
import TextAlign from "@canburaks/text-align-editorjs";
import IndentTune from 'editorjs-indent-tune';
import DragDrop from 'editorjs-drag-drop';
import Undo from 'editorjs-undo';
import NestedList from '@editorjs/nested-list';
import Checklist from '@editorjs/checklist';
import ChangeCase from 'editorjs-change-case';
import editorjsNestedChecklist from '@calumk/editorjs-nested-checklist';
import Table from '@editorjs/table';
import Hyperlink from 'editorjs-hyperlink';
import Strikethrough from '@sotaproject/strikethrough';
import ToggleBlock from 'editorjs-toggle-block';
import Alert from 'editorjs-alert';
import Embed from '@editorjs/embed';


window.initEditor = async (idEditor, readOnly, initValue) => {
  const editor = new EditorJS({
    /**
     * Id of Element that should contain Editor instance
     */
    holder: idEditor,
    readOnly: readOnly,
    onReady: () => {
      new Undo({ editor });
      new DragDrop(editor);

    },
    onChange: (editor, event) => {
      if (readOnly) { return; }
      editor.saver.save().then(data => {
        const input = document.getElementById(idEditor + '-input');
        if (!input) return;
        input.value = JSON.stringify(data);
      });
    },
    autofocus: true,
    tools: {
      header: {
        class: Header,
        inlineToolbar: true,
        config: {
          defaultLevel: 1
        },
        tunes: ['indentTune',],
      },
      paragraph: {
        class: Paragraph,
        inlineToolbar: true,
        config: {
        },
        tunes: ['indentTune',],
      },
      underline: Underline,
      textAlign: TextAlign,
      strikethrough: Strikethrough,
      alert: {
        class: Alert,
        inlineToolbar: true,
        shortcut: 'CMD+SHIFT+A',
        config: {
          defaultType: 'primary',
          messagePlaceholder: 'Enter something',
        },
      },
      indentTune: {
        class: IndentTune,
      },
      list: {
        class: NestedList,
        inlineToolbar: true,
        config: {
          defaultStyle: 'unordered',
        },
      },
      checklist: {
        class: Checklist,
        inlineToolbar: true,
        config: {
        },
      },
      nestedchecklist: editorjsNestedChecklist,
      changeCase: {
        class: ChangeCase,
        config: {
          showLocaleOption: true, // enable locale case options
          locale: 'tr' // or ['tr', 'TR', 'tr-TR']
        }
      },
      table: {
        class: Table,
        inlineToolbar: true,
        config: {
          rows: 2,
          cols: 3,
        },
      },
      hyperlink: {
        class: Hyperlink,
        config: {
          shortcut: 'CMD+L',
          target: '_blank',
          rel: 'nofollow',
          availableTargets: ['_blank', '_self'],
          availableRels: ['author', 'noreferrer'],
          validate: false,
        }
      },
      toggle: {
        class: ToggleBlock,
        inlineToolbar: true,
      },
      embed: Embed,
    },

    placeholder: 'Type here...',
    defaultBlock: 'paragraph'
  });
  editor.isReady.then(async () => {
    if (initValue) {
      const input = document.getElementById(idEditor + '-input');
      if (!input) return;
      input.value = JSON.stringify(initValue);
      await editor.render(initValue);
    }
  });

  return editor;
}
