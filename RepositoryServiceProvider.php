<?php

namespace App\Providers;

use App\Repositories\Contact\ContactPropertyRepository;
use App\Repositories\Contact\ContactPropertyRepositoryInterface;
use App\Repositories\Contact\ContactRelationRepository;
use App\Repositories\Contact\ContactRelationRepositoryInterface;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\Contact\ContactRepositoryInterface;
use App\Repositories\ContactStatus\ContactStatusRepository;
use App\Repositories\ContactStatus\ContactStatusRepositoryInterface;
use App\Repositories\Email\EmailRepository;
use App\Repositories\Email\EmailRepositoryInterface;
use App\Repositories\Feedback\FeedbackItemCommentRepository;
use App\Repositories\Feedback\FeedbackItemCommentRepositoryInterface;
use App\Repositories\Feedback\FeedbackItemRepository;
use App\Repositories\Feedback\FeedbackItemRepositoryInterface;
use App\Repositories\Feedback\FeedbackRepository;
use App\Repositories\Feedback\FeedbackRepositoryInterface;
use App\Repositories\Notification\NotificationRepository;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\PhoneNumber\PhoneNumberRepository;
use App\Repositories\PhoneNumber\PhoneNumberRepositoryInterface;
use App\Repositories\PostCode\PostCodeRepository;
use App\Repositories\PostCode\PostCodeRepositoryInterface;
use App\Repositories\Property\PropertyAuctionRepository;
use App\Repositories\Property\PropertyAuctionRepositoryInterface;
use App\Repositories\Property\PropertyEventRepository;
use App\Repositories\Property\PropertyEventRepositoryInterface;
use App\Repositories\Property\PropertyEventTypeRepository;
use App\Repositories\Property\PropertyEventTypeRepositoryInterface;
use App\Repositories\Property\PropertyImageRepository;
use App\Repositories\Property\PropertyImageRepositoryInterface;
use App\Repositories\Property\PropertyFeatureRepository;
use App\Repositories\Property\PropertyFeatureRepositoryInterface;
use App\Repositories\Property\PropertyKeyDetailRepository;
use App\Repositories\Property\PropertyKeyDetailRepositoryInterface;
use App\Repositories\Property\PropertyRepository;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\Stream\StreamRepository;
use App\Repositories\Stream\StreamRepositoryInterface;
use App\Repositories\Tag\AgentTagRepository;
use App\Repositories\Tag\AgentTagRepositoryInterface;
use App\Repositories\Tag\TagRepository;
use App\Repositories\Tag\TagRepositoryInterface;
use App\Repositories\Task\TaskRepository;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Property\PropertyMarketingRepository;
use App\Repositories\Property\PropertyMarketingRepositoryInterface;
use App\Repositories\Property\PropertyMarketingLinkRepository;
use App\Repositories\Property\PropertyMarketingLinkRepositoryInterface;
use App\Repositories\Property\PropertyCategoryRepository;
use App\Repositories\Property\PropertyCategoryRepositoryInterface;
use App\Repositories\Contact\ContactNoteRepository;
use App\Repositories\Contact\ContactNoteRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(PropertyRepositoryInterface::class, PropertyRepository::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(PhoneNumberRepositoryInterface::class, PhoneNumberRepository::class);
        $this->app->bind(EmailRepositoryInterface::class, EmailRepository::class);
        $this->app->bind(StreamRepositoryInterface::class, StreamRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(ContactStatusRepositoryInterface::class, ContactStatusRepository::class);
        $this->app->bind(AgentTagRepositoryInterface::class, AgentTagRepository::class);
        $this->app->bind(FeedbackRepositoryInterface::class, FeedbackRepository::class);
        $this->app->bind(FeedbackItemCommentRepositoryInterface::class, FeedbackItemCommentRepository::class);
        $this->app->bind(FeedbackItemRepositoryInterface::class, FeedbackItemRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PostCodeRepositoryInterface::class, PostCodeRepository::class);
        $this->app->bind(PropertyKeyDetailRepositoryInterface::class, PropertyKeyDetailRepository::class);
        $this->app->bind(PropertyEventTypeRepositoryInterface::class, PropertyEventTypeRepository::class);
        $this->app->bind(PropertyMarketingRepositoryInterface::class, PropertyMarketingRepository::class);
        $this->app->bind(PropertyMarketingLinkRepositoryInterface::class, PropertyMarketingLinkRepository::class);
        $this->app->bind(PropertyEventRepositoryInterface::class, PropertyEventRepository::class);
        $this->app->bind(PropertyAuctionRepositoryInterface::class, PropertyAuctionRepository::class);
        $this->app->bind(PropertyCategoryRepositoryInterface::class, PropertyCategoryRepository::class);
        $this->app->bind(ContactPropertyRepositoryInterface::class, ContactPropertyRepository::class);
        $this->app->bind(ContactRelationRepositoryInterface::class, ContactRelationRepository::class);
        $this->app->bind(PropertyImageRepositoryInterface::class, PropertyImageRepository::class);
        $this->app->bind(PropertyFeatureRepositoryInterface::class, PropertyFeatureRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
        $this->app->bind(ContactNoteRepositoryInterface::class, ContactNoteRepository::class);
    }
}
