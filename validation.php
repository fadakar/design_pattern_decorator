<?php
function dd(...$vars)
{
    var_dump(...$vars);
    die();
}


interface IAttributeValidation
{
    public function validate($value): bool;

    public function getMessage(): string;
}

#[Attribute]
class MaxLength implements IAttributeValidation
{
    public function __construct(
        public int    $maxLength,
        public string $message,
    )
    {

    }

    public function validate($value): bool
    {
        if (!empty($value) && strlen($value) > $this->maxLength)
            return true;
        return false;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}

#[Attribute]
class MinLength implements IAttributeValidation
{
    public function __construct(
        public int    $minLength,
        public string $message,
    )
    {

    }

    public function validate($value): bool
    {
        if (strlen($value) < $this->minLength)
            return true;
        return false;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}


#[Attribute]
class Required implements IAttributeValidation
{
    public function __construct(
        public string $message,
    )
    {

    }

    public function validate($value): bool
    {
        if (empty($value))
            return true;
        return false;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}




trait Validator{
    function validate(): array{
        $error = [];
        $props = array_keys(get_class_vars(self::class));
        foreach ($props as $prop)
        {
            $reflection = new ReflectionProperty(self::class , $prop);
            foreach ($reflection->getAttributes() as $attribute)
            {
                $validator = $attribute->newInstance();
                if($validator instanceof IAttributeValidation)
                {
                    if($validator->validate($this->{$prop}))
                    {
                        if(isset($error[$prop]))
                        {
                            $error[$prop] = [
                                ...$error[$prop],
                                $attribute->getName() => $validator->getMessage()
                            ];
                        }
                        else
                        {
                            $error[$prop] = [
                                $attribute->getName() => $validator->getMessage()
                            ];
                        }

                    }
                }
            }
        }
        return $error;
    }
}


class Post
{
    use Validator;


    #[MaxLength(4, 'max len is 4')]
    #[MinLength(2, 'min char is 2')]
    #[Required('title cannot be empty')]
    public $title;

    #[Required('body cannot be empty')]
    public $body;

    public $created_at;
    public $updated_at;
}


class User{
    use Validator;

    #[Required('username cannot be empty')]
    public $username;
    public $password;

    #[Required('username cannot be empty')]
    public $email;
}



$post = new Post();
$post->title = '';
$errors = $post->validate();


$user = new User();
$user->username = 'fadakar';
$errors = $user->validate();
dd($errors);