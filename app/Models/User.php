<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prefixname',
        'firstname',
        'middlename',
        'lastname',
        'suffixname',
        'username',
        'email',
        'password',
        'photo',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Base64 png format for default photo
     */
    protected $default_avatar = 
      "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAe1BMVEUAAAD////t7e3u7u7r6+vy8vL39/f09PT5+fnIyMi2"
    . "trZXV1fk5OTc3NzAwMDU1NSvr6+mpqaVlZUkJCQbGxtPT0+Pj49lZWWGhoagoKBeXl6AgIAhISEzMzOZmZnDw8N0dHRJSUkwMDBAQEALCwttbW0UFBR6enp"
    . "BQUGe4O/pAAAONUlEQVR4nN1d52KjMAwGjAczkD3aJM3qvf8THoQMm+khSFL98vWC0QfG+ixLsmXn4iCEnF5amBI62qXLxfHrYlnWaTq5nKzT5es7+N36o5"
    . "ARinvWwOq3f5Ysj1abBOP4YxFiO9p+t6J7oEyxjT8NISbOdiIFr5CZT2i/CDNxAVsk/FWAV8gK4150sfJmAdaFatFwo4wvl5RicF0cx0LgA5TOtfBlcvIZh"
    . "h6qCBwhi0+6ADP5iejbI1wY4MtlC47w+Um6AK2RIb78NVIgXe7fIRi47JGRpTnATGLiAGoFag9/QABa1pIBagWI0DGZYkSZvSXCCAxfJt8MGqE5e/AgAWam"
    . "Eb8Zp6EJLMBMImysFSSngQeYQTTWCtDiAw/Rm9D3QQg6yTxlCoMQgNM4/QC0rKOJVjYYp3EA7WBZFsyc3ZjbQzbrDWDGw82XGuYIYbhok3ivRwiwmmgVKIT"
    . "6nKFngNbCUD9TTsNMF7zdkuBXchoc9w7QspxXWnzan6F4ypm9DqG+V01JPJOtDTNOEw4C0PommvoZcxqi7tjWkx1+DafBPRHuqnyx11h8ch4KoZXQVyAc7h"
    . "Va1oS9gtNQve0XPYnxKzjNgACv7sXBOU0frplmcV9g8Q+DIpwPj3Aga/+Q4TnNMITtKaOhOQ0ZGKC1p5qa6trDfjykbUI0NdVFOB4coa7HRhehXCwQpMzNE"
    . "KozhcHlqKupFqfB/vAILTQkpxlocS9KjAe0+ARqx15FtlpLKF2ELwBoLchwnAZ1Lw2/4BFeyICcpsPeb2LUx3aGjqa69jBtU2Rs2xg5DH4yCjU01UXY8oK+"
    . "ndvvGPgCMh4QYdCoxYL7HTR3TU0QKjKFxgDnM+F/B7yGHGtoqslpWJMOgfg7HKrEenfKmQ7GaXCDCqfyFRivARH+kMEsftPoi6r9dyyzDipBAAc2FMImX/B"
    . "v7RXt842vsAy76CHU4DSoYe+e1V9B27Jmpio+OzIYp6l/h2NafwVqDR1OkTxEdU1tTXtY/w5J04BHrQEbRP4tqmsKinDfem3znLqy7X+fgXDUfm1zTIPdxp"
    . "HAEKoxhdrvsOvasAlGTsb20ggH4TS1c+mGdl7bZDeyp822MgjJUJym1h7GMhlL9Suqec5VJCJzNO0hFKeRSx+MajmMmz+dbpo+HKep46UzOc6IWFxjGzbXJ"
    . "BnW5d7S5KUanMapcURl5l7mWsfBLJlWrg4LjTo8Hwu5e4D4aaqLIk+hF5peSlf/2sWEVzOFcXFlYw1NNe0hqiqilONCSVIaq+79Y6lEsHBrk6O6proIa9YD"
    . "ir1gNhJYzuIRE1QyKXPejCyHQljjaQs0npPDLx1HD5c9Fr5GMYA1HITTOHX7TnPVXoqW/9D/hz3+l4bPoeoz4ZNfDMNp6ryEK+0s7Hh/e4n8/zr7O6LS4wz"
    . "V76FhD+v4ZaK1L1S0qDf+KRJkuL+5q/xjZ7ZbepLK99Cx+MId/e0VsGeA0MGU4CgNxf+lLEqy9xqtfD66LBgCIc+uRgST6+QXmSBs0u3awlhg5RoIlTkNR5"
    . "EDdp941A2xQotyCBt8QZCcBq+et8tXdjY93x9tbzC5L3+Eeuc0lLNi19Iy1z191V7UWpyFVP/gjRDurn/DhbO7R4TcslJ9M9/8HTpkbU0Ge4c7XYTyTAFzM"
    . "1tSvMPEOqj2otbi6PjzO+yP03ChNHNa/M36R5SZkUKLcEwfKfeibg858n++RUcER9LXAM1b/Gaeci8aFp/jUfcQ+uS7T4Q4HBghz9punz2Z9oqQ+y7UC2bo"
    . "+Gm45fnuliSwbtiUAWlhbvZeKvei4aeh3NydFn/DSU/gihbngYzVM6DUBzY/aILb31zlXlRa3GeBND4q5Xui0offm52/t3jPjUYvOoySu6M3AEKOs531ESq"
    . "xDI5ibMD5S7XFPdBkGD8N5n1t3TtOhi204+4WIfVeNOyh8CEmfZcfpdyImWjkPGvtzDAuuOIIWZarrsU/zjkdCCHllvnFGrFHhLx/eKRRVVEvnoZ/rt9q16"
    . "q2+G2uA9PoRXPviXe1p7RHJxTjdzcSrV70PCzCLliEe7OHRPCv6/Wi6UPid5+mLnjR0VuLCBtR80ERCre+RLp5Ze2tUhw1M0KozBTELcRNxLR6aWtRT9wgW"
    . "Wr2p5nLXQ040Yp1aW5VUzpsPU31c7nL2fjAxaorlW88zf4McrlLERU61liWVVh5XODwCEsRPgkwwr3Q+0S7P5P6NGJMwYaCGnsmBqTo1xY2qU8jmuMvWE5D"
    . "BYAR1u/PZNdINMgI1B7ySaoXZHKugNm+WMhFLCWgCDnmG5j1Z7jzx/lQZoAIEaAvyLDmHj9OKQLjNII1NOzPsOYePyGMtXuptrhAzMCQLRnWoOVrRZ20e6m"
    . "0+JqvqRlbMq2yKyTme2AI+Whp1/CTNq0jzA/TGRhCrtO1VgY3j1Cf01xbQj2sSLeXUovnpL6BsTflNEWLDzwLdFKvqi0hjNy4P/NIGD7+3IOg33y0x22Cfq"
    . "HFt8V0n6NRIc6ihYRwRPcNEDI+ZNs3d/KTPdffBqwWtAFnECu5mJ/ZJHgqb2kKL+Q01xb/EpemkTV88Ey+eWfMkSDq6guLqJFZpCkRMqOJuX2FOTmAn06nB"
    . "oU4M44kjNGxkVaQCAWXzVkn/+reokJovplWd4SGnKZoCa5FX9tj4zAhZSY21AqI0+QtJJ7/4Nq6j02YlmcM4uEDnRVEBf/t1NYb+lh0UBp5ZyAtftFai09f"
    . "qxexoEgKoBUkQlG7sU7dXyLsxPxAaMUhNOAMt5ZXgqjaC6JiAi0F0coGPMOS7UWIyr2IObIrrVo0dS248w+pWMDsV2m6waIhzNOKYbSCPOGRlrJ4AyTP30g"
    . "5VX9pxIz6QlhOtr9EsrnXrLSVlscGwSEE4TR5C1erCaVShxlhVC0LsjX0zkBzmqJVk3m5Zp0xvYjU1aBIwLSCPOGxtgJdytqjbahbe1KND6YVJML6qq2HHW"
    . "v2bFDaUPHjPRE21e74aT49vbGiSQyOEII9NFcnmSTMtoWdqTxBNGypHbkD0wrwXO722sKz1TUNG+eSN0bz1gqnPtwJ3XD2sLt6cjBPU99P0tWms0ibD5ZXD"
    . "GjxeYR7nXOg1txX+Z4IOWuRtNT2apKUr0YBiRCO03AKJm3zTq0cXcGgJm/JaTiEKXaou1cAmDBUfkRvx2lC3k2WDzJkR7JVvzfVqWofgmgFhBAT7Itl8+45"
    . "5V5bUcgHGKfoD4tLqB8/6/ctEFIaVwoDhY+JYtdVTm/zPNi4Uu1rH9M32Hvy6g5fI8+lEYnm5apQTzmm6J4kkq8yan7x6xnqZ8ZpwrT+CMug9LvRuG60Bqt"
    . "ytZn6grSLRKMqzbOlZw9xNnhG20Zm4peuQJTgXbKc3V/mNJgnHiUUlX7XyIqO21HO+Iay+Jlq3rbt89rXhe4XSyjkhu4NdU3PwvZv5ZVv84fSL8IrZya7eY"
    . "cRmOtv5neVqv+Ze/nTU3mb8pwGExL6afeBgBNPP+TEcYjXWQH8dE79kBAs2bMUp3EwxbtUimmeUk1wz1YqxdoX6S7TypHoT8YehqlkjdhDQsxjMXClIF+Tr"
    . "NNQor9uhL5sUfG9x2CSLijz9pL3nPlmCDFxZQ/i+ElyxyfUkicbCYls+eSlQ1onnhZOg0q1DdskbexFv9V6TAgvi9EjdECN05SSOtplxYBzuaue/hbJLHAj"
    . "jiZ7iInKHTJZsjJDMWkhpnhOTdo0VJssPomUj6hcQ+atU2UvyKFhH6gBodIQucsEgSFEOid/rGpHUT2n0T13I7bNjP29pXkm/aLuEMg6ToNdmZV5/T0cWTL"
    . "VQg9R/ZJMQo5ujQOrag/NzmouL5zUWybH8p3Cqt+jgtD0MOoAGSE0PZgmqhSWKCMEOG17Xr/4k1joNJWlV4JYntLLnAbkiKYVygiqMpOhWGcGL8spLPVc4j"
    . "QY6HzRLVNmMnLHI3TLN27jNExymSQh+xGjsu5OTFm0B7vzmon2kEdIQM/AnY4jJuNXyeCNQY9L3JImhBj8GOPDPOqYWmw7GoOfYc5nzvOcxsE6u36dskhHi"
    . "BH6TFO4TdqUMDRqcLgaygnz3+Gj6dp13msY+TpvfX8U3hgPdsKR72/PPZzkeZMNP5c+XiduO5Tp0yTCZXuY/ZuCnuT3YpmQKkI6/Fnifcrz8OA7p0Fu91Uf"
    . "JS4qc5oeTrd9qSzLnKbpWMrPFVqy+OWCOp8vGxEh7b7i44QInOYVp8H3LXOe09Qcb/QHBHHWAmLp+X6y4hD+JTrzlMkToblv5j0leiD8e6aikOWN06C/aCo"
    . "KIQWnAXAgvqvkiyhLJnz5Y8UvEFLpzdaPk5ReOQ3+wwhxwWk0N7M+QOKbtfjDM83dHr5akd7kYfHhfPnvJcED4V/9EOOHn4b04ux+uVyudQ6va/xK0d6/If"
    . "kJZg8vhuHe8lvKQvREge//vFwO5b0noM3ft5Fjee8JmQZBvJksHpEEz50Z9peWGDGr2Xty7FLxjs+VX9YYTxN2x+K/v5xdYTu9HE8TfbrP5p4p1hYjHH8uT"
    . "Q1iuxKpUxtfGqay8fnvJEHqlnA0R9AiypC/nHZ3+jYynfuominWFgV9TQjA/vITnOGHZYybUyG68p6IE2/P7wtzct7GqC4yWDHviSAvXa7fa4V1WS/TESIS"
    . "2svlAeNrPm64W22C/sJ85OQr2Kx2eYQllgwMVMt0zkO1KIt2yXY/G3bsHmb7bbKLsrs/AsgkddbN5c6gMkxDL07Gy3Nw7OPNfh2D83KcxF5IMWO39FH16GO"
    . "rdJ16i1JKrt8Di0Ze7Md58ZL58nd/XqxnP8fvw2TyNb1cLqcT/yFn/zpdptOvyeTw/e9ntl6c97/L+SpNsutjb3Q9PsomhN7el4l+/wEltywKmAYhKQAAAA"
    . "BJRU5ErkJggg==";

    /**
     * Retrieve the default photo from storage.
     * Supply a base64 png image if the `photo` column is null.
     *
     * @return string
     */
    public function getAvatarAttribute()
    {
        return $this->photo == null ? $this->default_avatar : asset($this->photo);
    }
}
