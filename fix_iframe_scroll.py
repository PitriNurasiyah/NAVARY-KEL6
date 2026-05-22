import os
import re

indices = [
    r'd:\Project 2\Navary\resources\views\manajemenAkun\manajemenAkun.blade.php',
    r'd:\Project 2\Navary\resources\views\biodatasapi\biodata_sapi.blade.php',
    r'd:\Project 2\Navary\resources\views\peternak\pakan\index.blade.php',
    r'd:\Project 2\Navary\resources\views\peternak\produksi\index.blade.php',
    r'd:\Project 2\Navary\resources\views\peternak\siklus\index.blade.php'
]

creates = [
    r'd:\Project 2\Navary\resources\views\manajemenAkun\create.blade.php',
    r'd:\Project 2\Navary\resources\views\biodatasapi\create.blade.php',
    r'd:\Project 2\Navary\resources\views\peternak\pakan\create.blade.php',
    r'd:\Project 2\Navary\resources\views\peternak\produksi\create.blade.php',
    r'd:\Project 2\Navary\resources\views\peternak\siklus\create.blade.php'
]

for idx in indices:
    if os.path.exists(idx):
        with open(idx, 'r', encoding='utf-8') as f:
            content = f.read()
        
        # Modify .iframe-container height
        content = re.sub(r'height:\s*(750px|650px|85vh);', '', content)
        if '.iframe-container {' in content and 'height: auto;' not in content:
            content = content.replace('.iframe-container {', '.iframe-container {\n            height: auto;\n            overflow: hidden;')
        
        # Modify iframe tag to add onload
        onload_str = """onload="setTimeout(() => { if(this.contentWindow.document.body) { this.style.height = (this.contentWindow.document.body.scrollHeight + 50) + 'px'; } }, 50);" """
        
        if 'onload="setTimeout' not in content:
            content = content.replace('<iframe id="registerIframe" src="" scrolling="no"></iframe>',
                                      f'<iframe id="registerIframe" src="" scrolling="no" {onload_str}></iframe>')
        
        with open(idx, 'w', encoding='utf-8') as f:
            f.write(content)

for cr in creates:
    if os.path.exists(cr):
        with open(cr, 'r', encoding='utf-8') as f:
            content = f.read()
            
        # We want to hide scrollbar in iframe again
        custom_scroll = """body::-webkit-scrollbar { width: 8px; }
        body::-webkit-scrollbar-track { background: transparent; }
        body::-webkit-scrollbar-thumb { background: rgba(166, 124, 82, 0.5); border-radius: 10px; }
        body::-webkit-scrollbar-thumb:hover { background: rgba(166, 124, 82, 0.8); }"""
        
        content = content.replace(custom_scroll, 'body::-webkit-scrollbar { display: none; }')
        
        # Ensure overflow is hidden when in modal mode so no scrollbar appears in the iframe
        if "overflow-y: auto;" in content:
            content = content.replace("overflow-y: auto;", "overflow-y: {{ request('mode') == 'modal' ? 'hidden' : 'auto' }};")
            
        with open(cr, 'w', encoding='utf-8') as f:
            f.write(content)

print("Applied iframe resize fix.")
