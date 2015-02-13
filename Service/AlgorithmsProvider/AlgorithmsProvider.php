<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Bundle\PayUBundle\Service\AlgorithmsProvider;

use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmInterface;
use Team3\PayU\SignatureCalculator\Encoder\Algorithms\AlgorithmsProviderInterface;

class AlgorithmsProvider implements AlgorithmsProviderInterface
{
    /**
     * @var AlgorithmInterface
     */
    private $algorithms;

    public function __construct()
    {
        $this->algorithms = [];
    }

    /**
     * @return AlgorithmInterface[]
     */
    public function getAlgorithms()
    {
        return $this->algorithms;
    }

    /**
     * @param AlgorithmInterface $algorithm
     */
    public function addAlgorithm(AlgorithmInterface $algorithm)
    {
        $this->algorithms[] = $algorithm;
    }
}
