FROM fluent/fluentd:v1.3-onbuild-1

# Use root account to use apk
USER root

# below RUN includes plugin as examples elasticsearch is not required
# you may customize including plugins as you wish
RUN apk add --no-cache --update --virtual .build-deps \
        sudo build-base ruby-dev git openssh \
 && apk add gettext mysql-dev \
 && sudo gem install \
        fluent-plugin-elasticsearch eventmachine fluent-plugin-mysql-replicator:1.0.1 \
 && sudo gem sources --clear-all \
 && apk del .build-deps \
 && rm -rf /home/fluent/.gem/ruby/2.5.0/cache/*.gem

RUN chown fluent:fluent /fluentd/etc/fluent.conf

USER fluent

CMD /bin/sh -c "/usr/bin/envsubst < /fluentd/etc/fluent.template.conf > /fluentd/etc/fluent.conf" \
      && fluentd -c /fluentd/etc/fluent.conf -v