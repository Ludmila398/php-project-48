module CC
  module Analyzer
    class IssueValidator
      include Validator

      def self.validations
        IssueValidations.validations
      end
    end
  end
end
