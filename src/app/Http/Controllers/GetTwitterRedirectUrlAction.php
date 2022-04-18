<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\Usecases\Signin\GetRedirectUrlInterface;
use App\ValueObjects\User\OauthProviderName;

class GetTwitterRedirectUrlAction extends Controller
{
    /**
     * @var GetRedirectUrlInterface
     */
    private GetRedirectUrlInterface $usecase;

    /**
     * @param GetRedirectUrlInterface $usecase
     */
    public function __construct(GetRedirectUrlInterface $usecase)
    {
        $this->usecase = $usecase;
    }

    /**
     * @return string
     */
    public function __invoke(): string
    {
        $oauthProvider = OauthProviderName::TWITTER;
        return $this->usecase->process($oauthProvider);
    }
}
