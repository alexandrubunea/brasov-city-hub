import fs from 'fs-extra';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const source = path.resolve(__dirname, 'node_modules', 'tinymce');
const destination = path.resolve(__dirname, 'public', 'tinymce');

fs.copySync(
    path.join(source, 'skins'),
    path.join(destination, 'skins')
);

console.log('TinyMCE skins copied successfully!');
