# ToUnicode (Zawgyi to Unicode Converter)
ဇော်ဂျီဖြင့် ရေးသားထားသော input values များကို unicode(ယူနီကုဒ်) အဖြစ်ပေြာင်းလဲပေးမယ့် laravel package လေးတစ်ခုပါ။ လောလောဆယ်တော့  Laravel5 အတွက်ပဲရပါဦးမယ်။
#### composer နဲ့ဘယ်လိုယူရမလဲ?
``` composer require kknts/tounicode ```
#### ထည့်သွင်းအသုံးပြုပုံ
composer နဲ့ package ကိုရပြီးပြီဆိုရင် providers array (```config/app.php```)ထဲသို့  package ရဲ့ service provider ထဲပေးပါ။

```php
'providers' => [
    ...
    Kyawnaingtun\Tounicode\TounicodeServiceProvider::class,
    ...
]
```

#### Model မှအသုံးပြုပုံ
အရင်ဆုံး ယခု converter ကိုအသုံးပြုမည့် Model file ထဲသို့သွားပါ။ အောက်ပါအတိုင်း trait ကို ထည့်ပါ။ ကွျန်တော်ကတော့ auto convert ဖြစ်အောင် mutator နဲ့ define လုပ်လိုက်ပါတယ်။
```php
# model/post.php
namespace App;
use Kyawnaingtun\Tounicode\TounicodeTrait;
use Illuminate\Database\Eloquent\Model;
class Post extends Model
{
    use TounicodeTrait;//use converter trait
    protected $fillable = [
        'title', 'content'
    ];
    //Defining A Mutator
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = $this->toUnicode($value);
    }
}
```
အထက်က mutator ကတော့ post table ထဲက content attribute တစ်ခုတည်းကို convert လုပ်လိုက်တာပါ။

#### Controller မှအသုံးပြုပုံ
Model ကနေ  အသုံးမပြုချင်ဘူးဆိုရင် Controller ကနေလည်း အသုံးပြုနိုင်ပါတယ်။
```php
namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;
use Kyawnaingtun\Tounicode\TounicodeTrait;//first inject here
class PostController extends Controller
{
    use TounicodeTrait;//use it
    public function store(Request $request)
    {
        $title = $request->title;
        $content = $request->content;
        return $this->toUnicode($content);//output testing
    }
}
```
controller ကနေ $this->toUnicode() ဆိုတဲ့ function ကိုသုံးပြီး အလုပ်လုပ်သွားတာပါ။

### Conclusion
ဒီ laravel package လေးကို အသုံးပြုပြီးတော့ zawgyi နှင့် unicode ပြဿနာအား တစိတ်တပုိင်းဖြေရှင်းနိုင်လိမ့်မည်ဟု ယုံကြည်ပါတယ်။ ဒီထက် ပိုကောင်းဖို့အတွက်လည်း ဆက်လက် လုပ်ဆောင်သွားပါမယ်။


### Credits
[Ko Saturngod (Rabbit)](https://github.com/Rabbit-Converter/Rabbit)
[Ko Satkyar (mmfont)](https://github.com/setkyar/mmfont)
