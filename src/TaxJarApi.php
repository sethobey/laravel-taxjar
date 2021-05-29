<?php

namespace LaraJar;

use Illuminate\Support\Collection;
use LaraJar\Contracts\Customer;
use LaraJar\Contracts\Order;
use LaraJar\Contracts\Refund;
use LaraJar\Models\TaxJarApiLog;
use Carbon\Carbon;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use LaraJar\Util\Util;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use TaxJar\Client;

class TaxJarApi
{
    /**
     * The TaxJar PHP SDK client
     * @var Client
     */
    protected $client;

    /**
     * The current logging instance
     * @var TaxJarApiLog
     */
    private $taxJarApiLogInstance;

    public function __construct(Client $client)
    {
        if (config('taxjar.logging_enabled')) {
            /** @var HandlerStack $handler */
            $handler = $client->getApiConfig('handler');

            $handler->push(Middleware::mapRequest(function (RequestInterface $request) {
                $this->taxJarApiLogInstance = TaxJarAPILog::create([
                    'api_endpoint' => (string) $request->getUri(),
                    'method' => $request->getMethod(),
                    'payload_sent' => (string) $request->getBody(),
                    'sent_at' => Carbon::now(),
                ]);

                return $request;
            }));

            $handler->push(Middleware::mapResponse(function (ResponseInterface $response) {
                $this->taxJarApiLogInstance->update([
                    'response_code' => $response->getStatusCode(),
                    'payload_received' => (string) $response->getBody(),
                    'received_at' => Carbon::now(),
                ]);

                $this->taxJarApiLogInstance = null;

                return $response;
            }));

            $client->setApiConfig('handler', $handler);
        }

        $client->setApiConfig('timeout', config('taxjar.default_timeout'));

        $this->client = $client;
    }

    /**
     * @return Collection|Category[]
     */
    public function categories()
    {
        $response = $this->client->categories();

        return Util::convertToLaraJarObject($response, Category::OBJECT_NAME);
    }

    public function ratesForLocation(string $zip, array $additionalFields = []): object
    {
        $response = $this->client->ratesForLocation($zip, $additionalFields);

        return Util::convertToLaraJarObject($response, Rate::OBJECT_NAME);
    }

    public function taxForCharge(
        array $fromAddress,
        array $toAddress,
        array $lineItems,
        float $shippingCost,
        string $exemptionType = 'non_exempt'
    ): object {

        $response = $this->client->taxForOrder([
            'from_country' => $fromAddress['country'],
            'from_zip' => $fromAddress['zip'],
            'from_state' => $fromAddress['state'],
            'from_city' => $fromAddress['city'],
            'from_street' => $fromAddress['street'],
            'to_country' => $toAddress['country'],
            'to_zip' => $toAddress['zip'],
            'to_state' => $toAddress['state'],
            'to_city' => $toAddress['city'],
            'to_street' => $toAddress['street'],
            'shipping' => $shippingCost,
            'line_items' => $lineItems,
            'exemption_type' => $exemptionType,
        ]);

        return Util::convertToLaraJarObject($response, Tax::OBJECT_NAME);
    }

    public function listOrders(array $params = []): object
    {
        return $this->client->listOrders($params);
    }

    public function showOrder($transaction, array $params = []): object
    {
        if ($transaction instanceof Order) {
            $transaction = $transaction->getTaxJarOrderTransactionId();
        }

        return $this->client->showOrder($transaction, $params);
    }

    public function createOrder(array $params): object
    {
        return $this->client->createOrder($params);
    }

    public function updateOrder($order, array $orderDetails = []): object
    {
        if ($order instanceof Order) {
            $orderId = $order->getTaxJarOrderTransactionId();
        }

        if (empty($orderDetails)) {
            $orderDetails = $order->getTaxJarOrderDetails();
        }

        return $this->client->updateOrder(
            array_merge($orderDetails, [
                'transaction_id' => $orderId ?? $order,
            ])
        );
    }

    public function deleteOrder($order, array $params = []): object
    {
        if ($order instanceof Order) {
            $order = $order->getTaxJarOrderTransactionId();
        }

        return $this->client->deleteOrder($order, $params);
    }

    public function listRefunds(array $params = []): object
    {
        return $this->client->listRefunds($params);
    }

    /**
     * @param Refund|string $transaction
     * @param array $params
     * @return object
     */
    public function showRefund($transaction, array $params = []): object
    {
        if ($transaction instanceof Refund) {
            $transaction = $transaction->getTaxJarRefundTransactionId();
        }

        return $this->client->showRefund($transaction, $params);
    }

    public function createRefund(array $params): object
    {
        return $this->client->createRefund($params);
    }

    public function updateRefund($refund, array $params = []): object
    {
        if ($refund instanceof Order) {
            $refundId = $refund->getTaxJarOrderTransactionId();
        }

        if (empty($params)) {
            $params = $refund->getTaxJarOrderDetails();
        }

        return $this->client->updateRefund(
            array_merge($params, [
                'transaction_id' => $refundId ?? $refund,
            ])
        );
    }

    public function deleteRefund($refund, array $params = []): object
    {
        if ($refund instanceof Refund) {
            $refund = $refund->getTaxJarRefundTransactionId();
        }

        return $this->client->deleteRefund($refund, $params);
    }

    public function listCustomers(array $params = []): object
    {
        return $this->client->listCustomers($params);
    }

    /**
     * @param Refund|string $customer
     * @return object
     */
    public function showCustomer($customer): object
    {
        if ($customer instanceof Customer) {
            $customer = $customer->getTaxJarCustomerId();
        }

        return $this->client->showCustomer($customer);
    }

    public function createCustomer(array $params): object
    {
        return $this->client->createCustomer($params);
    }

    public function updateCustomer($customer, array $params = []): object
    {
        if ($customer instanceof Order) {
            $customerId = $customer->getTaxJarOrderTransactionId();
        }

        if (empty($params)) {
            $params = $customer->getTaxJarCustomerDetails();
        }

        return $this->client->updateCustomer(
            array_merge($params, [
                'customer_id' => $customerId ?? $customer,
            ])
        );
    }

    public function deleteCustomer($customer): object
    {
        if ($customer instanceof Customer) {
            $customer = $customer->getTaxJarCustomerId();
        }

        return $this->client->deleteCustomer($customer);
    }
}
