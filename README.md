# ToUnicode (Laravel Easy Converter)
[![dev-master](https://img.shields.io/packagist/v/kyawnaingtun/tounicode.svg)](https://packagist.org/packages/kyawnaingtun/tounicode)
[![Download](https://img.shields.io/packagist/dt/kyawnaingtun/tounicode.svg)](https://packagist.org/packages/kyawnaingtun/tounicode)

ဇော်ဂျီဖြင့် ရေးသားထားသော input values များကို unicode(ယူနီကုဒ်) အဖြစ် automatic ပြောင်းလဲပေးမည့် laravel package လေးတစ်ခုပါ။ Zawgyi/Unicode အား auto detect သိဖို့ရန်အတွက် ကူညီပေးသော ကွီးဖြိုးဇော်ထွန်း အား အထူးကျေးဇူးတင်ရှိပါသည်။ :D (မှတ်ချက်။။ converter ၏ unicode font သို့ ပြောင်းလဲမှုသည် ၁၀၀% မမှန်နိုင်ပါ။)

AngularJs (Front-End) အတွက်ဆိုရင်တော့ [ဒီမှာ](https://github.com/KyawNaingTun/ng-z2u-converter) လာယူပါ။

### composer နဲ့ဘယ်လိုယူရမလဲ?
```composer require kyawnaingtun/tounicode```

### Auto Convert on Save
အရင်ဆုံး ယခု converter ကိုအသုံးပြုမည့် Model file ထဲသို့သွားပါ။ အောက်ပါအတိုင်း ```TounicodeTrait``` ကို ထည့်ပါ၊ သင်ပြောင်းလဲလိုသော table field name ကို ဒီထဲမှာ ```protected $tounicode=[]``` ထည့်ပေးပါ။ အထက်ပါလုပ်ဆောင်ချက်အားလုံးပြီးပါက၊ ယခု Post model မှ title နှင့် content သည် user ထည့်လိုက်သည့် data မှန်သမျှ အားလုံးကို unicode auto ပြောင်းပေးသွားမည်ဖြစ်သည်။ ထို့အပြင်၊ ယခင်ကရှိနှင့်ပြီးသား Zawgyi content များကိုလည်း Unicode ပြောင်းပြီး ပြန်ထုတ်ပေးမှာ ဖြစ်ပါသည်။
```php
# your-model-folder/post.php
namespace App;

use Illuminate\Database\Eloquent\Model;

use Kyawnaingtun\Tounicode\TounicodeTrait;

class Post extends Model
{
    use TounicodeTrait;

    protected $table = 'post';

    protected $fillable = ['title', 'content'];

    /**
     * These are the attributes to convert before saving.
     * To covert automatically from Non-Unicode to Unicode fonts
     * @var array
     */
    protected $tounicode = ['title','content'];

}
```
### Global Helper functions
သင်ပြောင်းလဲလိုသော value ကို အောက်ပါ function အသုံးပြုပြီး ပြောင်းလဲနိုင်သည်။
```php
tounicode($value);//will convert to unicode value
```
ဖောင့်အမျိုးအစားသိချင်လျှင် အောက်ပါ function ဖြင့်စစ်နိုင်သည်။
```php
/**
 * return string: uni, zg, mm, eng
 * uni = unicode
 * zg = zawgyi
 * mm = myanmar font
 * eng = english
 */
 checkFontType($value);
```
### Conclusion
ဒီ laravel package လေးကို အသုံးပြုပြီးတော့ zawgyi နှင့် unicode ပြဿနာအား တစိတ်တပိုင်းဖြေရှင်းနိုင်လိမ့်မည်ဟု ယုံကြည်ပါတယ်။

## Supported Versions

| Laravel Version | Supported          |
| ------- | ------------------ |
| 11.*   | :white_check_mark: |
| 10.*   | :white_check_mark: |
| 9.*   | :white_check_mark: |
| 8.*   | :white_check_mark: |
| 7.*   | :white_check_mark: |
| 6.*   | :white_check_mark: |
| 5.*   | :white_check_mark: |
| < 5.0   | :x:                |

### Credits
[Ko Phyo Zaw Tun (Future ICT Solution)](https://www.facebook.com/PhyoZawTun)
[Ko Saturngod (Rabbit)](https://github.com/Rabbit-Converter/Rabbit)
[Ko Satkyar (mmfont)](https://github.com/setkyar/mmfont)
