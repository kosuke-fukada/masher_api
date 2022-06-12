<?php
declare(strict_types=1);

namespace App\Usecases\Inquiry\PostInquiry;

use App\Interfaces\Factories\Inquiry\InquiryFactoryInterface;
use App\Interfaces\Repositories\Inquiry\InquiryRepositoryInterface;
use App\Interfaces\Services\Inquiry\PostInquiry\SendInquiryMailServiceInterface;
use App\Interfaces\Usecases\Inquiry\PostInquiry\PostInquiryInputPort;
use App\Interfaces\Usecases\Inquiry\PostInquiry\PostInquiryInterface;

class PostInquiry implements PostInquiryInterface
{
    /**
     * @var InquiryFactoryInterface
     */
    private InquiryFactoryInterface $inquiryFactory;

    /**
     * @var InquiryRepositoryInterface
     */
    private InquiryRepositoryInterface $inquiryRepository;

    /**
     * @var SendInquiryMailServiceInterface
     */
    private SendInquiryMailServiceInterface $sendInquiryMailService;

    /**
     * @param InquiryFactoryInterface $inquiryFactory
     * @param InquiryRepositoryInterface $inquiryRepository
     * @param SendInquiryMailServiceInterface $sendInquiryMailService
     */
    public function __construct(
        InquiryFactoryInterface $inquiryFactory,
        InquiryRepositoryInterface $inquiryRepository,
        SendInquiryMailServiceInterface $sendInquiryMailService
    )
    {
        $this->inquiryFactory = $inquiryFactory;
        $this->inquiryRepository = $inquiryRepository;
        $this->sendInquiryMailService = $sendInquiryMailService;
    }

    /**
     * @param PostInquiryInputPort $input
     * @return void
     */
    public function process(PostInquiryInputPort $input): void
    {
        // Entityを作成
        $inquiry = $this->inquiryFactory->createInquiry(
            $input->name(),
            $input->email(),
            $input->body()
        );

        // DBに保存
        $this->inquiryRepository->registerInquiry($inquiry);

        // 問い合わせしたユーザーにメール送信
        $this->sendInquiryMailService->sendMail($inquiry);
    }
}
