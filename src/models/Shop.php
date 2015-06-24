<?php
namespace pastuhov\ymlcatalog\models;

class Shop extends BaseModel
{
    public static $tag = false;

    public $name;
    public $company;
    public $url;
    public $platform;
    public $version;
    public $agency;
    public $email;
    public $cpa;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                ['name', 'company', 'url'],
                'required',
            ],
            [
                ['name'],
                'string',
                'max' => 20,
            ],
            [
                ['company', 'url', 'platform', 'version', 'agency', 'email'],
                'string',
                'max' => 255,
            ],
            [
                ['email'],
                'email',
            ],
            [
                ['cpa'],
                'in',
                'range' => ['1', '2'],
            ],
        ];
    }

    protected function getYmlBody()
    {
        $string = '';

        foreach ($this->attributes() as $attribute) {
            $string .= $this->getYmlAttribute($attribute);
        }

        return $string;
    }

    protected function getYmlAttribute($attribute)
    {
        $value = $this->getAttributeValue($attribute);
        if ($value === null) {
            return '';
        }

        $string = '<' . $attribute . '>' . $value . '</' . $attribute. '>' . PHP_EOL;

        return $string;
    }
}
